<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Merchant;
use App\Models\User;

class MerchantsController extends Controller
{
    public function __construct()
    {
//        $this->middleware('auth');
    }

    public function getMerchants(Request $request)
    {
//        var_dump($request->all());
        $total=Merchant::count();
        $pageSize=$request->currentPageSize;
        $page=$request->currentPage;
        $merchants = Merchant::offset(($page-1)*$pageSize)->limit($pageSize)->get()->toArray();
        return response()->json(['code' => 200, 'merchants' => $merchants,'total'=>$total]);
    }
}
