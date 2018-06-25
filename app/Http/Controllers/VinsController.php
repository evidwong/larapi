<?php

namespace App\Http\Controllers;

use App\Models\Vin;
use Illuminate\Http\Request;

class VinsController extends Controller
{
    public function getVinConfigs(Request $request)
    {
        $total = Vin::where('is_del',0)->count();
        $pageSize = $request->currentPageSize;
        $page = $request->currentPage;
        $rows = Vin::where('is_del',0)->offset(($page - 1) * $pageSize)->limit($pageSize)->get()->toArray();
        return response()->json(['code' => 0, 'data' => $rows, 'total' => $total]);
    }

    public function createVinConfig(Request $request)
    {
        $data = $request->all();
        if ($data['id']) {
            $brand = Vin::find($data['id']);
            $brand->update($data);
            return response()->json(['code' => 0, 'msg' => '修改成功']);
        } else {
            unset($data['id']);
            Vin::create($data);
            return response()->json(['code' => 0, 'msg' => '添加成功']);
        }
    }

    public function deleteVinConfig(Request $request)
    {
        Vin::where('id', $request->id)->update(['is_del' => 1]);
        return response()->json(['code' => 0, 'msg' => '删除成功']);
    }
}
