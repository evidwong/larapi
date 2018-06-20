<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Merchant;
use App\Models\User;

class MerchantsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getList(Merchant $merchant,User $user)
    {
        $this->authorize('getList');
        $merchants = $merchant->paginate(10);
        return response()->json(['code' => 200, 'merchants' => $merchants]);
    }
}
