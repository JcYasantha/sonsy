<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
class viewinvoiceController extends Controller
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
        $out = json_decode($request->getContent('dataI'), true);
        $formData = $out['dataI'];

        foreach ($formData as $inv) {
            foreach ($inv as $c) {
                if(empty($c['amount'])){
                    $c['amount']=0;
                }
                DB::update('update outstanding__payments set SettledAmount = ? , Balance = ? where InvoiceNo=?',[$c['SettledAmount'] +$c['amount'], $c['Balance']-$c['amount'] , $c['InvoiceNo']]);
                //return $c['Balance']-$c['amount'];
            }
        } 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $invoices = DB::table('outstanding__payments')->where('CustomerID', $id)->where('Balance','>',0)->get();
        return $invoices;
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
