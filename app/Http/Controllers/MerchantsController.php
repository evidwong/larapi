<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Merchant;

class MerchantsController extends Controller
{
    public function getList(Merchant $merchant)
    {
        $merchants = $merchant->pagination(10);
        return response()->json(['code' => 200, 'merchants' => $merchants]);
    }
}
