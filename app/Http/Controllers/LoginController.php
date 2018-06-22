<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class LoginController extends Controller
{
	protected $successCode=200;
    public function login(Request $request)
    {

    	// var_dump($request->all());
        if (Auth::attempt(['email' => $request->email, 'password' => $request->passcode])) {
            $user = Auth::user();
            return response()->json(['user' => $user,'msg'=>'','code'=>0]);
        } else {
            return response()->json(['msg' => 'Unauthorised','code'=>-1]);
        }
    }
}
