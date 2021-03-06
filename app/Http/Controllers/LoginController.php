<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Spatie\Permission\Models\Permission;


class LoginController extends Controller
{
    protected $successCode = 200;

    public function login(Request $request)
    {

//    	 dd($request->all());
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
//            dd($user);
            $permissions = $user->getAllPermissions()->map(function ($permise) {
                if ($permise['pid']==0 && $permise['is_menu']>0){
                    $permise['children'] = Permission::where(['pid'=>$permise->id,'is_menu'=>1])->get()->map(function($child){
                        $child['children']=Permission::where(['pid'=>$child->id,'is_menu'=>1])->get()->toArray();
                        return $child;
                    })->toArray();
                }
                return $permise;
            })->toArray();
            $menu = [];
            foreach ($permissions as $per) {
                if ($per['is_menu'] > 0 && $per['pid'] <= 0) {
                    $menu[] = $per;
                }
            }
//            var_dump($menu);
            return response()->json(['user' => $user, 'msg' => '', 'code' => 0,'menu'=>$menu]);
        } else {
            return response()->json(['msg' => 'Unauthorised', 'code' => -1]);
        }
    }
}
