<?php

namespace App\Http\Controllers;

use App\Commodity;
use App\ExportOrder;
use App\Customer;
use App\ExportOrderDetail;
use App\TopCustomer;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ExportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $orders = ExportOrder::orderBy('created_at', 'desc')->withCount('details')->paginate(25);
        foreach ($orders as $order) {
            if ($order->details_count == 0) {
                $data = ExportOrder::where('code', $order->code)->forceDelete();
            }
        }
        $version = '1.2';
        $currentPage = 'Bán hàng';
        $pages = [
            ['name' => 'Sell', 'link' => route('home')]
        ];
        return view('export.index', compact('orders', 'version', 'currentPage', 'pages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $customers = Customer::withCount('orders')->get();
        $version = '1.2';
        $currentPage = 'Xuất bill Bán hàng';
        $pages = [
            ['name' => 'Sell', 'link' => route('home')]
        ];
        return view('export.create', compact('customers', 'version', 'currentPage', 'pages'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            /*            'code' => 'required|unique:export_orders|max:25',*/
            'customer_code' => 'required|exists:customers,code|max:25',
            'commodity_code' => 'required|exists:commodities,code|max:25',
            'profit' => 'required',
            'quantity' => 'required',
            'price' => 'required'
        ]);
        // tạo mã hóa đơn
        $code = date('dmy') . '_' . date('His');

        //kiểm tra tồn kho
        foreach ($validatedData['commodity_code'] as $key => $value) {
                $commodity = Commodity::whereCode($value)->first();
            if ($commodity->warehouse - $validatedData['quantity'][$key] < 0) {
                return redirect(route('export.index'))->with('error', $commodity->name . ' đã hết hàng');
            }
        }

        // lưu hóa đơn
        $newExportOrder = new ExportOrder([
            'code' => $code,
            'customer_code' => $validatedData['customer_code']
        ]);
        $newExportOrder->save();

        // lưu sản phẩm vào hóa đơn
        $exportOrder = ExportOrder::whereCode($code)->first();
        foreach ($validatedData['commodity_code'] as $key => $value) {
            //echo "$key - $value\n";
            $commodity = Commodity::whereCode($value)->first();
                if ($commodity) {
                    $detail = new ExportOrderDetail([
                        'commodity_code' => $commodity->code,
                        'unit' => $commodity->unit,
                        'quantity' => $validatedData['quantity'][$key],
                        'price' => $validatedData['price'][$key],
                        'profit' => $validatedData['profit'][$key],
                    ]);
                    $exportOrder->details()->save($detail);

                    // trừ tồn kho
                    $commodity->update([
                        /*'code' => $commodity->code,*/
                        'warehouse' => $commodity->warehouse - $validatedData['quantity'][$key]
                    ]);
                    $commodity->save();

                    // lưu tổng tiền khách hàng
                    $topCustomer = TopCustomer::where('customer_code',$validatedData['customer_code'])->first();
                    if ($topCustomer){
                        $topCustomer->update([
                            'price' => $topCustomer->price  + $validatedData['price'][$key],
                        ]);
                        $topCustomer->save();
                    }else{
                        $data = new TopCustomer([
                            'customer_code' => $validatedData['customer_code'],
                            'price' => $validatedData['price'][$key],
                        ]);
                        $data->save();
                    }
                }
        }
        return redirect(route('export.index'))->with('status', 'Xuất bill thành công');
    }


    /**
     * Display the specified resource.
     *
     * @param string $code
     * @return Response
     */
    public function show($code)
    {
        $export = ExportOrder::where('code',$code)->firstOrFail();

        $version = '1.2';
        $currentPage = "Chi Tiết Đơn hàng " . $code;
        $pages = [
            ['name' => 'Trang chủ', 'link' => route('home')],
            ['name' => 'Bán hàng', 'link' => route('export.index')]
        ];

        return view('export.show', compact('export', 'version', 'currentPage', 'pages'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param string $code
     * @return Response
     */
    public function destroy($code)
    {
        $export = ExportOrder::whereCode($code)->withCount('details')->first();
        $export_details = ExportOrderDetail::where('order_code', $code)->get();

        foreach( $export_details as $export_detail) {
            $commodity = Commodity::where('code', $export_detail->commodity_code)->first();
            $commodity->update([
                'warehouse' => $commodity->warehouse + $export_detail->quantity
            ]);
            $commodity->save();

            $top_customer = TopCustomer::where('customer_code',$export->customer_code)->first();
            $top_customer->update([
                'price' => $top_customer->price - $export_detail->price
            ]);
            $top_customer->save();
        }


        if ($export->trashed() == false) {
            $export->forceDelete();
            return redirect(route('export.index'))->with('status', 'Xóa Thành Công');

        }
        return redirect(route('export.index'))->with('error', 'Xóa Thất Bại');
    }

    public function destroyDetails($code)
    {
        $export = ExportOrderDetail::whereCode($code)->firstOrFail();

        if ($export->trashed() == false) {
            $export->forceDelete();
            return redirect(route('export.index'))->with('status', 'Xóa Thành Công');

        }
        return redirect(route('export.index'))->with('error', 'Xóa Thất Bại');
    }
}