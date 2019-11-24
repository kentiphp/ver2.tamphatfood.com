<?php

namespace App\Http\Controllers;

use App\Expense;
use App\ExportOrder;
use App\ImportOrder;
use Illuminate\Http\Request;

class SalesReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $version = '1.2';
        $currentPage = 'Báo cáo doanh thu';
        $pages = [
            ['name' => 'Báo cáo', 'link' => route('home')]
        ];
        return view('salesreport.index', compact( 'version', 'currentPage', 'pages'));
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
        $validatedData = $request->validate([
            'date_min' => 'nullable',
            'date_max' => 'nullable',
        ]);

        $orders = ImportOrder::orderBy('created_at','desc')->whereBetween('created_at', [$validatedData['date_min'], $validatedData['date_max']])->withCount('details')->paginate(1000);
        $order1s = ExportOrder::orderBy('created_at','desc')->whereBetween('created_at', [$validatedData['date_min'], $validatedData['date_max']])->withCount('details')->paginate(1000);
        $expenses = Expense::orderBy('created_at','desc')->whereBetween('created_at', [$validatedData['date_min'], $validatedData['date_max']])->paginate(1000);

        $getTotalImport = 0;
        $getTotalExport = 0;
        $getTotalProfit = 0;

        foreach ($orders as $order) {
            $getTotalImport = $getTotalImport + $order->getTotal();
        }
        foreach ($order1s as $order1) {
            $getTotalExport = $getTotalExport + $order1->getTotal();
            $getTotalProfit = $getTotalProfit + $order1->details->sum('profit');
    }


        $version = '1.2';
        $currentPage = 'Báo cáo doanh thu từ '. date('d-m-Y',strtotime($validatedData['date_min'])).' đến '.date('d-m-Y',strtotime($validatedData['date_max']));
        $pages = [
            ['name' => 'Báo cáo', 'link' => route('home')]
        ];
        return view('salesreport.show', compact('orders', 'order1s', 'expenses', 'getTotalImport', 'getTotalExport', 'getTotalProfit', 'version', 'currentPage', 'pages'));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

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
