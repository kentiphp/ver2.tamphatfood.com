<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::resources(['login' => 'LoginController']);
Auth::routes();
Route::get('/', function () {
    return redirect(route('dashboard.index'));
});
Route::get('/home', 'DashboardController@index')->name('home');

Route::group(['middleware' => 'CheckLevel'], function () {
    Route::resources(['suppliers' => 'SupplierController']);
    Route::resources(['commodities' => 'CommodityController']);
    Route::resources(['customers' => 'CustomerController']);
    Route::resources(['import' => 'ImportController']);
    Route::resources(['export' => 'ExportController']);
    Route::resources(['warehouse' => 'WarehouseController']);
    Route::resources(['salesreport' => 'SalesReportController']);
    Route::resources(['expense' => 'ExpenseController']);
    Route::resources(['dashboard' => 'DashboardController']);
});



