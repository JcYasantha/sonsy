<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\ContactFormMail;
use Illuminate\Support\Facades\Mail;


class MailFormController extends Controller
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
            foreach ($inv as $data) {
                if(empty($data['amount'])){
                    return 0;
                }
                
                //DB::update('update outstanding__payments set SettledAmount = ? , Balance = ? where InvoiceNo=?',[$c['SettledAmount'] +$c['amount'], $c['Balance']-$c['amount'] , $c['InvoiceNo']]);

                
                // $data = request([
                //     'id' => $c['CustomerID'],
                //     'InvoiceNo' => $c['InvoiceNo'],
                //     'InvoiceValue' => $c['InvoiceValue'],
                //     'Ammount' => $c['amount'],
                //     'Balance' => $c['Balance'],
                // ]); 
                Mail::to('test@test.com')->send(new ContactFormMail($data));
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
