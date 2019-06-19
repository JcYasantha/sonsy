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

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Stock::all();
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $invoice_products = json_decode($request->getContent('dataD','formD'), true);
        $formData = $invoice_products['formD'];
        $pro_info = $invoice_products['dataD'];
        
        $invoice = new Invoice;
        $invoice-> CustomerID = $formData['cli']['id'];
        $invoice-> Outstanding= $formData['cli']['Outstanding'];
        $invoice->save();

        $InvoiceNo = DB::getPdo()->lastInsertId();

        $outstanding = new Outstanding_Payments;
        $outstanding -> InvoiceNo = $InvoiceNo;
        $outstanding -> InvoiceValue = $formData['cli']['Outstanding'];
        $outstanding->save();

        foreach ($pro_info as $inv) {
            foreach ($inv as $c) {
                Item::create([
                    'InvoiceNo' => $InvoiceNo,
                    'Items' => $c['itemname']['id'],
                    'Quantity' => $c['quantity'],
                    'Amount' => $c['line_total'],
                ]);
                $itemQuantity = Stock::select('Quantity')
                    ->where('ItemName','=', $c['itemname']['id'])
                    ->first();
                DB::update('update stocks set Quantity = ? where ItemName = ?',[$itemQuantity['Quantity'] - $c['quantity'],$c['itemname']['id']]);
            }
        }
        return $InvoiceNo;
        /* $invoice = new Invoice;
        $invoice-> CustomerID = $request -> CustomerID;
        $invoice-> Outstanding= $request -> Outstanding;
        $invoice->save();

        $InvoiceNo = DB::getPdo()->lastInsertId();
                
        $outstanding = new Outstanding_Payments;
        $outstanding -> InvoiceNo = $InvoiceNo;
        $outstanding -> InvoiceValue = $request -> Outstanding;
        $outstanding->save();

            return $invoice_products; */
        
         /* foreach ($invoice_products as $invoice_product) {

            return Item::create([
                'InvoiceNo' => $InvoiceNo,
                'Items' => $invoice_product['itemname'],
                'Quantity' => $invoice_product['quantity'],
                'Amount' => $invoice_product['line_total'],
            ]);
       }  */
        
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
        dd($id);
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
    public function search(){
        if($search = \Request::get('q')){
            $stocks = Stock::where(function($query) use ($search){
                $query->where('ItemName','LIKE',"%$search%");
            })->get();
        }else{
            return Stock::all();
        }
        return $stocks;
    }
}
