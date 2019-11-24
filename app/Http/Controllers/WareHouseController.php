<?php

namespace App\Http\Controllers;

use App\Commodity;
use Illuminate\Http\Response;

class WarehouseController extends Controller
{
    public function index()
    {
        $warehouses = Commodity::orderBy('warehouse', 'asc')->paginate();
        $sumPriceWarehouse = 0;
        foreach ($warehouses as $warehouse) {
            $sumPriceWarehouse = $sumPriceWarehouse + ($warehouse->warehouse * $warehouse->entry_price);
        };
        $sumPriceWarehouse =\App\Services\MyHelper::moneyFormating($sumPriceWarehouse);
        $version = '1.2';
        $currentPage = 'Tồn kho';
        $pages = [
            ['name' => 'Kho', 'link' => route('home')]
        ];
        return view('warehouse.index', compact('warehouses','sumPriceWarehouse', 'version', 'currentPage', 'pages'));
    }
}
