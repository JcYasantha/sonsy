<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use DB;
use App\Http\Controllers\Controller;
use App\User;
class UserController extends Controller
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
        $users = DB::table('users')
        ->where('type', '!=', 'admin')->get();
        return $users;
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
            'name' => 'required|string|max:191',
            'email' => 'required|string|email|max:191|unique:users',
            'type' => 'required',
        ]);
        return User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'type' => $request['type'],
            'password' => Hash::make($request['email']),
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateProfile(Request $request){
        $user=auth('api')->user();

        $this->validate($request,[
            'name' => 'required|string|max:191',
            'email' => 'required|string|email|max:191|unique:users,email,'.$user->id,
            'Telephone' => 'regex:/^0([0-9\s\-\+\(\)]*)$/|min:10',
            
        ]);



        $currentPhoto=$user->photo;
        if($request->photo!=$currentPhoto){
            $extention=explode('/',explode(':',substr($request->photo,0,strpos
            ($request->photo,';')))[1])[1];
            if($extention=='jpeg'||$extention=='jpg'||$extention=='png'||$extention=='gif'){
                $name=time().'.'.explode('/',explode(':',substr($request->photo,0,strpos
            ($request->photo,';')))[1])[1];
            \Image::make($request->photo)->save(public_path('img/profile/').$name);
            
             $request->merge(['photo'=>$name]);

                $userPhoto=public_path('img/profile/').$currentPhoto;

             if(file_exists($userPhoto)){
                @unlink($userPhoto);
             }

            }
            

             

        }
        if(!empty($request->password)){
           $request->merge(['password' => Hash::make($request['password'])]);
        }

       $user->update($request->all()); 
    }
    public function updatePassword(Request $request){
        $user=auth('api')->user();

        $this->validate($request, [
        
            'oldPassword' =>'required|string|min:6|max:20',
            'newPassword'     => 'required|string|min:6|max:20',
            'confirmPassword' => 'required|same:newPassword',
        ]);
        $data = $request->all();
     
        $user = User::find(auth()->user()->id);
        if(!Hash::check($data['oldPassword'], $user->password)){
            return response()->json(['errors' => ['input password in not match with current password']], 400);
        }else{
            $request->merge(['password' => Hash::make($request['confirmPassword'])]);
        }
        $user->update($request->all()); 

    }




    public function profile(){
        return Auth('api')->user();
    }




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
        
        $this->authorize('isAdmin');
        $users = User::findOrFail($id);
        $users -> delete();
    }
}
