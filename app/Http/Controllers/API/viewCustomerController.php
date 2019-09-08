<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Customer;
use App\Http\Controllers\Controller;

class viewCustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Customer::latest()->paginate(10);
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
    public function findUser()
    {
        if($search=\Request::get('q')){
            $users=Customer::where(function($query) use ($search){
                $query->where('Fname','LIKE',"%$search%")->orWhere('Lname','LIKE',"%$search%")->orWhere('City','LIKE',"%$search%")->orWhere('No','LIKE',"%$search%")->orWhere('Street','LIKE',"%$search%")->orWhere('NicNo','LIKE',"%$search%");
            })->paginate(10);
        }
        return $users;
    }

  






    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
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
