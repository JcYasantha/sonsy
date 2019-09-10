<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Stock;
class StockController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(\Gate::allows('isAdmin') || \Gate::allows('isStockKeeper')){
            return Stock::latest()->paginate(10);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'ItemName' => 'required|string|max:191',
            'UnitPrice' => 'required|numeric|min:0',
            'SupplierId' => 'required|numeric|min:0',
            'InvoiceNo' => 'required|numeric|min:0',
            'Quantity' => 'required|numeric|min:0',
            'SellingPrice' => 'required|numeric|min:0',
        ]);
        return Stock::create([
            'Discount' => 0,
            'ItemName' => $request['ItemName'],
            'UnitPrice' => $request['UnitPrice'],
            'SupplierId' => $request['SupplierId'],
            'InvoiceNo' => $request['InvoiceNo'],
            'Quantity' => $request['Quantity'],
            'SellingPrice' => $request['SellingPrice'],
            'TotalBalance' => $request['UnitPrice'] * $request['Quantity'],
        ]);
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
        $stocks = Stock::findOrFail($id);
        $this->validate($request,[
            'Discount' => 'required|numeric|min:0',
            'ItemName' => 'required|string|max:191',
            'UnitPrice' => 'required|numeric|min:0',
            'SupplierId' => 'required|numeric|min:0',
            'InvoiceNo' => 'required|numeric|min:0',
            'Quantity' => 'required|numeric|min:0',
            'SellingPrice' => 'required|numeric|min:0',
            'TotalBalance' => 'required|numeric|min:0',
        ]);
        $stocks->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       //$this->authorize('isAdmin');

        $stocks = Stock::findOrFail($id);
        $stocks -> delete();
    }
}
