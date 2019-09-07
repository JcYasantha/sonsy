<?php

namespace App\Http\Controllers\API;
use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Stock;
use App\Invoice;
use App\Customer;
use App\Item;
use App\Outstanding_Payments;

class cancelOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $invoice_products = json_decode($request->getContent('dataD','formD'), true);
        $formData = $invoice_products['formD'];
        $pro_info = $invoice_products['dataD'];

        $invoice = Invoice::where('id', $id);
        $invoice -> delete();

        $outstanding = Outstanding_Payments::where('InvoiceNo', $id);
        $outstanding -> delete();

        foreach ($pro_info as $inv) {
            foreach ($inv as $c) {
                $itemQuantity = Stock::select('Quantity')
                    ->where('ItemName','=', $c['itemname']['id'])
                    ->first();
                DB::update('update stocks set Quantity = ? where ItemName = ?',[$itemQuantity['Quantity'] + $c['quantity'],$c['itemname']['id']]);
            }
        }

        $items = Item::where('InvoiceNo', $id);
        $items -> delete();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
