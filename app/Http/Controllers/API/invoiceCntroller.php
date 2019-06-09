<?php

namespace App\Http\Controllers\API;
use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Invoice;
use App\Item;
class invoiceCntroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Invoice::latest()->first();
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
    public function show($InvoiceNo)
    {
        //$getItems = DB::select('select * from items where InvoiceNo="$InvoiceNo"');
        $getItems = DB::table('items')->where('InvoiceNo', $InvoiceNo)->get();
        return $getItems;
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
        //
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
