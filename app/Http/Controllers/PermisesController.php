<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermisesController extends Controller
{
    public function getNodes(Request $request)
    {

        $pageSize = $request->currentPageSize;
        $page = $request->currentPage;
        if ($page) {
            $total = Permission::count();
            $rows = Permission::offset(($page - 1) * $pageSize)->limit($pageSize)->get()->toArray();
        } else {
            $total = 0;
            $rows = Permission::where('pid', 0)->get()->map(function ($permise) {
                $permise['value'] = $permise['id'];
                $permise['label'] = $permise['title'];
                $permise['children'] = Permission::where('pid', $permise->id)->get()->map(function ($child) {
                    $child['value'] = $child['id'];
                    $child['label'] = $child['title'];
                    return $child;
                })->toArray();

                return $permise;
            })->toArray();
            array_unshift($rows, ['id' => 0, 'value' => 0, 'label' => '顶级']);
        }

        return response()->json(['code' => 0, 'data' => $rows, 'total' => $total]);
    }

    public function createNode(Request $request)
    {
        $data = $request->all();
        $data = array_filter($data);
        if (isset($data['pid'])) {
            $data['pid'] = array_pop($data['pid']);
        }
        if (isset($data['id'])) {
            $node = Permission::find($data['id']);
            $node->update($data);
            return response()->json(['code' => 0, 'msg' => '修改成功']);
        } else {
            Permission::create($data);
            return response()->json(['code' => 0, 'msg' => '添加成功']);
        }
    }

    public function deleteNode(Request $request)
    {
        Permission::where('id', $request->id)->delete();
        return response()->json(['code' => 0, 'msg' => '删除成功']);
    }

    public function getRoles(Request $request)
    {
        $total = Role::count();
        $pageSize = $request->currentPageSize;
        $page = $request->currentPage;
        if ($page) {
            $rows = Role::offset(($page - 1) * $pageSize)->limit($pageSize)->get()->toArray();
        } else {
            $total = 0;
            $rows = Role::where('pid', 0)->get()->map(function ($role) {
                $role['value'] = $role['id'];
                $role['label'] = $role['title'];
                $role['children'] = Role::where('pid', $role->id)->get()->map(function ($child) {
                    $child['value'] = $child['id'];
                    $child['label'] = $child['title'];
                    return $child;
                })->toArray();
                if (!$role['children']) {
//                    unset($role['children']);
                }
                return $role;
            })->toArray();
        }
        return response()->json(['code' => 0, 'data' => $rows, 'total' => $total]);
    }

    public function createRole(Request $request)
    {
        $data = $request->all();
        $data = array_filter($data);
        if (isset($data['id'])) {
            $role = Role::find($data['id']);
            $role->update($data);
            return response()->json(['code' => 0, 'msg' => '修改成功']);
        } else {
            Role::create($data);
            return response()->json(['code' => 0, 'msg' => '添加成功']);
        }
    }

    public function deleteRole(Request $request)
    {
        Role::where('id', $request->id)->delete();
        return response()->json(['code' => 0, 'msg' => '删除成功']);
    }
}
