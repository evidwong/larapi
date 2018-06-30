<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BrandsController extends Controller
{
    public function getBrands()
    {
        $rows = DB::table('car_brands')->get();
        $newRows = [];
        $tempAlpha = ['group_name' => '', 'index' => 0];
        foreach ($rows as $key => $row) {
            $row = (array)$row;
            if ($tempAlpha['group_name'] != $row['alpha']) {
                if ($tempAlpha['group_name'] != '') {
                    $newRows[] = $tempAlpha;
                }
                $tempAlpha = ['group_name' => $row['alpha'], 'index' => $key];
            }
            $tempAlpha['children'][] = $row;

        }
        return response()->json(['code' => 0, 'msg' => '', 'data' => $newRows]);
    }

    public function getBrandConfigs(Request $request)
    {
        $total = Brand::where('is_del', 0)->count();
        $pageSize = $request->currentPageSize;
        $page = $request->currentPage;
        if ($page) {
            $rows = Brand::where('is_del', 0)->offset(($page - 1) * $pageSize)->limit($pageSize)->get()->toArray();
        } else {
            $rows = Brand::where('is_del', 0)->get()->toArray();
        }

        return response()->json(['code' => 0, 'data' => $rows, 'total' => $total]);
    }

    public function createBrandConfig(Request $request)
    {
        $data = $request->all();
        $data = array_filter($data);
        if (isset($data['id'])) {
            $brand = Brand::find($data['id']);
            $brand->update($data);
            return response()->json(['code' => 0, 'msg' => '修改成功']);
        } else {
            unset($data['id']);
            Brand::create($data);
            return response()->json(['code' => 0, 'msg' => '添加成功']);
        }
    }

    public function deleteBrandConfig(Request $request)
    {
        Brand::where('id', $request->id)->update(['is_del' => 1]);
        return response()->json(['code' => 0, 'msg' => '删除成功']);
    }
}
