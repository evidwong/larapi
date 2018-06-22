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
        $total = Merchant::where('is_del', 0)->count();
        $pageSize = $request->currentPageSize;
        $page = $request->currentPage;
        $merchants = Merchant::where('is_del', 0)->offset(($page - 1) * $pageSize)->limit($pageSize)->get()->toArray();
        return response()->json(['code' => 0, 'merchants' => $merchants, 'total' => $total]);
    }

    public function createMerchants(Request $request)
    {

        $data = $request->all();
        $data['auth_start_time'] = $data['auth_time'][0];
        $data['auth_end_time'] = $data['auth_time'][1];
        $data['city'] = implode(',', $data['city']);
        $data['auth_brand'] = implode(',', $data['auth_brand']);
        unset($data['id']);
        unset($data['auth_time']);
        Merchant::create($data);
        return response()->json(['code' => 0, 'msg' => '添加成功']);
    }

    public function update(Request $request, Merchant $merchant)
    {
        $data = $request->all();
        $data['auth_start_time'] = $data['auth_time'][0];
        $data['auth_end_time'] = $data['auth_time'][1];
        $data['city'] = implode(',', $data['city']);
        $data['auth_brand'] = implode(',', $data['auth_brand']);
        $merchant->update($data);
        return response()->json(['code' => 0, 'msg' => '修改成功']);
    }

    public function deleteMerchants(Merchant $merchant, Request $request)
    {
        Merchant::where('id', $request->id)->update(['is_del' => 1]);
        return response()->json(['code' => 0, 'msg' => '删除成功']);
    }

    public function delayMerchants(Merchant $merchant, Request $request)
    {
        Merchant::where('id', $request->id)->update(['service_expire' => $request->expire]);
        return response()->json(['code' => 0, 'msg' => '延期成功']);
    }

    public function destroy(Merchant $merchant)
    {
        $merchant->update(['is_del' => 1]);
        return response()->json(['code' => 0, 'msg' => '删除成功']);
    }
}
