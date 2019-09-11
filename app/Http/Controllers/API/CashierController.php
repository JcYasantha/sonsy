<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\postdated_cheques;
use DB;

class CashierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
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
            'chequeNo' => 'required|string|min:0',
            'chequeDate' => 'required|date',
            'Bank' => 'required|string|max:191',
            'Branch' => 'required|string|max:191',
            'ChequeBalance' => 'required|numeric|min:0',
            'CustomerID' => 'required|numeric|min:0',
            
            
        ]);
        return postdated_cheques::create([
            'chequeNo' => $request['chequeNo'],
            'chequeDate' => $request['chequeDate'],
            'ChequeBalance' => $request['ChequeBalance'],
            'Branch' => $request['Branch'],
            'Bank' => $request['Bank'],
            'CustomerID' => $request['CustomerID'],
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
       
    }

   
}
