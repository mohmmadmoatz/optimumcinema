<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Hash;
class UserController extends Controller
{
    public function login(Request $request)
    {
            
   
           //Check email
   
           $user= User::where('email', $request->email)->first();
   
           //Check Password
           if(!$user || !Hash::check($request->password, $user->password) ){
               return response([
                   'success'=>false,
                   'message'=>'Invalid Credentials'
               ], 200);
           }
   
        //   $token = $user->createToken('myapptoken')->plainTextToken;
   
           $response= [
               'success'=>true,
               'user' => $user,
              
           ];
   
           return response($response, 200);
    }

    public function register(Request $request)
    {
       $user = new User();
       $user->name=$request->name;
       $user->email = $request->email;
       $user->password = bcrypt($request->password);
       $user->save();
       $response= [
        'success'=>true,
        'user' => $user,
       
    ];

    return response($response, 200);
      
    }



    public function loginweb()
    {
        
        
        return view('login', ['data' => '']);
        
    }

    public function signup()
    {
        
        
        return view('signup', ['data' => '']);
        
    }
}
