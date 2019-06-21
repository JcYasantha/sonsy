<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Supplier;
class SupplierController extends Controller
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
        $this->validate($request,[
            'Name' => 'required|string|max:191',
            'PhoneNO' => 'required|numeric|min:10',
            'Email' => 'required|string|email|max:191|unique:users',
            'No' => 'required|string|max:191',
            'Street' => 'required|string|max:191',
            'City' => 'required|string|max:191',
        ]);
        return Supplier::create([
            'Name' => $request['Name'],
            'PhoneNO' => $request['PhoneNO'],
            'Email' => $request['Email'],
            'No' => $request['No'],
            'Street' => $request['Street'],
            'City' => $request['City']
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
        //
    }
}
