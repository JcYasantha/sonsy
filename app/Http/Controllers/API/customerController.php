<?php

namespace App\Http\Controllers\API;
use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Customer;
class customerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Customer::all();
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
            'Fname' => 'required|string|max:191',
            'Lname' => 'required|string|max:191',
            'No' => 'required|numeric|regex:/^0([0-9\s\-\+\(\)]*)$/|min:9|max:10',
            'City' => 'required|string|max:191',
            'Street' => 'required|string|max:191',
            'NicNo' => 'required|string|min:10',
        ]);
        return Customer::create([
            'Fname' => $request['Fname'],
            'Lname' => $request['Lname'],
            'No' => $request['No'],
            'City' => $request['City'],
            'Street' => $request['Street'],
            'NicNo' => $request['NicNo']
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($CustomerID)
    {
        //$customerDetails = DB::table('customers')->find($CustomerID);
        $customerDetails = Customer::findOrFail($CustomerID);
        return $customerDetails;
        /* $customerDetails = DB::table('Customer')->find($id);
        return $customerDetails; */
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
