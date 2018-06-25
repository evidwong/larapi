<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BaseInfo;

class BaseInfosController extends Controller
{
    public function getBaseInfo(Request $request)
    {
        $baseInfos = BaseInfo::where([
                ['type','=', $request->type],
                ['status','=', 1]
            ])->get();
        return response()->json(['code' => 0, 'msg' => '', 'baseInfos' => $baseInfos->toArray()]);
    }
}
