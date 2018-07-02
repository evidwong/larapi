<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function getUsers(Request $request)
    {

        $pageSize = $request->currentPageSize;
        $page = $request->currentPage;
        if ($page) {
            $total = User::count();
            $rows = User::offset(($page - 1) * $pageSize)->limit($pageSize)->get()->toArray();
        } else {
            $total = 0;
            $rows = User::where('pid', 0)->get()->toArray();
        }

        return response()->json(['code' => 0, 'data' => $rows, 'total' => $total]);
    }

    public function createUser(Request $request)
    {
        $data = $request->all();
        $data = array_filter($data);
        if (isset($data['id'])) {
            $node = User::find($data['id']);
            $node->update($data);
            return response()->json(['code' => 0, 'msg' => '修改成功']);
        } else {
            User::create($data);
            return response()->json(['code' => 0, 'msg' => '添加成功']);
        }
    }

    public function deleteUser(Request $request)
    {
        User::where('id', $request->id)->delete();
        return response()->json(['code' => 0, 'msg' => '删除成功']);
    }
}
