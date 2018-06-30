<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BaseInfo;

class BaseInfosController extends Controller
{
    public function getBaseInfos(Request $request)
    {
        $pageSize = $request->currentPageSize;
        $page = $request->currentPage;
        if ($page) {
            $baseInfos = BaseInfo::where([
                ['type', '=', $request->type],
                ['status', '=', 1]
            ])->offset(($page - 1) * $pageSize)->limit($pageSize)->get();
            $json = ['code' => 0, 'msg' => '', 'data' => $baseInfos->toArray()];
        } else {
            $baseInfos = BaseInfo::where([
                ['type', '=', $request->type],
                ['status', '=', 1]
            ])->get();
            $json = ['code' => 0, 'msg' => '', 'data' => $baseInfos->toArray()];
        }
        return response()->json($json);
    }

    public function createBaseInfo(Request $request)
    {
        $data = $request->all();
        $data = array_filter($data);
        if (isset($data['id'])) {
            $baseinfo = BaseInfo::find($data['id']);
            $baseinfo->update($data);
            return response()->json(['code' => 0, 'msg' => '修改成功']);
        } else {
            BaseInfo::create($data);
            return response()->json(['code' => 0, 'msg' => '添加成功']);
        }
    }

    public function deleteBaseInfo(Request $request)
    {
        BaseInfo::where('id', $request->id)->update(['is_del' => 1]);
        return response()->json(['code' => 0, 'msg' => '删除成功']);
    }
}
