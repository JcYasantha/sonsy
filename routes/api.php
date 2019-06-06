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

Route::get('findStock','API\OrderController@search');
Route::apiResources(['stock'=>'API\OrderController']);
Route::apiResources(['invoice'=>'API\OrderController']);
Route::apiResources(['invoiceget'=>'API\invoiceCntroller']);
Route::apiResources(['outstanding'=>'API\outstandingController']);
Route::apiResources(['customer'=>'API\customerController']);
Route::apiResources(['stocks' => 'API\StockController']);
Route::apiResources(['supplier' => 'API\SupplierController']);
