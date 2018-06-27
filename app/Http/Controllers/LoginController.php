<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;


class LoginController extends Controller
{
    protected $successCode = 200;

    public function login(Request $request)
    {

//    	 dd($request->all());
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
//            dd($user);
            $permissions = $user->getAllPermissions()->toArray();
            $menu = [];
            foreach ($permissions as $per) {
                if ($per['is_menu'] > 0) {
                    $menu[] = $per;
                }
            }
            var_dump($menu);
            return response()->json(['user' => $user, 'msg' => '', 'code' => 0]);
        } else {
            return response()->json(['msg' => 'Unauthorised', 'code' => -1]);
        }
    }
}
