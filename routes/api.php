<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResources(['outstandings' => 'API\CashierController']);

Route::get('findStock','API\OrderController@search');
Route::get('customerID/{CustomerID}', 'API\customerController@show');
Route::get('getItems/{InvoiceNo}', 'API\invoiceCntroller@show');
Route::get('ViewOutstanding/{id}', 'API\OutstandingAndPayments@show');
Route::get('totalOutstanding/{id}', 'API\totalOutstandingController@show');
Route::get('loadOutstanding/{id}', 'API\viewinvoiceController@show');
Route::apiResources(['stock'=>'API\OrderController']);
Route::apiResources(['invoice'=>'API\OrderController']);
Route::apiResources(['cancelOrder'=>'API\cancelOrderController']);
//Route::apiResources(['invoiceEdit'=>'API\OrderController@te']);
Route::apiResources(['savePayment'=>'API\viewinvoiceController']);
//Route::post('invoice',array('as' => 'invoice', 'uses' => 'API\OrderController@store'));
Route::apiResources(['invoiceget'=>'API\invoiceCntroller']);
Route::apiResources(['outstanding'=>'API\outstandingController']);
Route::apiResources(['customer'=>'API\customerController']);
Route::apiResources(['stocks' => 'API\StockController']);
Route::apiResources(['users' => 'API\UserController']);
Route::apiResources(['addusers' => 'API\UserController']);
Route::apiResources(['supplier' => 'API\SupplierController']);
Route::apiResources(['View' => 'API\viewCustomerController']);
Route::apiResources(['postdated_cheques' => 'API\CashierController']);
Route::apiResources(['lordcustomer' => 'API\viewController']);
