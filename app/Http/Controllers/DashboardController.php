<?php

namespace App\Http\Controllers;

use App\Commodity;
use App\Customer;
use App\Expense;
use App\ExportOrder;
use App\TopCustomer;
use DateTime;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // xác đinh thứ 2 và chủ nhật
        $date_time = getdate();
        $day = $date_time['wday'] - 1;
        $date = new DateTime($date_time['mday'] . '-' . $date_time['mon'] . '-' . $date_time['year']);
        $date->modify("-{$day} day");
        $monday = $date->format("Y-m-d");
        $sunday = date("Y-m-d", strtotime("$monday +7 day"));

        // lấy danh sách khách hàng đã dặt hàng trong 1 tuần
        $export = ExportOrder::select('customer_code')->whereBetween('created_at', [$monday, $sunday])->get();
        // lấy ra danh sách khách hàng chưa đặt hàng trong tuần
        $customers = Customer::whereNotIn('code', $export)->withCount('orders')->paginate(20);
        // lấy ra danh sách khách hàng  đặt hàng trong tuần
        $topCustomers = Customer::WhereIn('code', $export)->withCount('orders')->paginate(10);

        // lấy top khách hàngs
        $top_customers = TopCustomer::orderBy('price', 'DESC')->with('customer')->paginate(10);


        $version = '1.2';
        $currentPage = 'Trang Chủ';
        $pages = [
            ['name' => 'Dashboard', 'link' => route('home')]
        ];
        return view('dashboards.index', compact('customers', 'topCustomers', 'top_customers', 'version', 'currentPage', 'pages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param int $code
     * @return \Illuminate\Http\Response
     */
    public function show($code)
    {
        $exports = ExportOrder::where('customer_code', $code)->withCount('details')->get();
        $customer = Customer::where('code',$code)->first();
        $version = '1.2';
        $currentPage =$customer->name . '( ' . $customer->phone_number . ' - ' . $customer->namecustomer . ')';
        $pages = [
            ['name' => 'Trang chủ', 'link' => route('home')],
            ['name' => 'Bán hàng', 'link' => route('export.index')]
        ];

        return view('dashboards.show', compact('exports', 'version', 'currentPage', 'pages'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
