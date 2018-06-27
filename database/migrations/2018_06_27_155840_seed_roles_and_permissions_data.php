<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class SeedRolesAndPermissionsData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // 清除缓存
        app()['cache']->forget('spatie.permission.cache');

        // 先创建权限
        $permission = Permission::create(['name' => 'manage_permission', 'title' => '权限管理', 'path' => '/promise', 'is_menu' => 1]);

        // 角色权限
        $manage_roles = Permission::create(['name' => 'manage_roles', 'title' => '角色管理', 'path' => '/promise/roles', 'pid' => $permission->id, 'is_menu' => 1]);
        Permission::create(['name' => 'create_update_role', 'title' => '添加修改角色', 'pid' => $manage_roles->id]);
        Permission::create(['name' => 'delete_role', 'title' => '删除角色', 'pid' => $manage_roles->id]);

        // 用户权限
        $manage_users = Permission::create(['name' => 'manage_users', 'title' => '用户管理', 'path' => '/promise/users', 'is_menu' => 1]);
        Permission::create(['name' => 'create_update_user', 'title' => '添加修改用户', 'pid' => $manage_users->id]);
        Permission::create(['name' => 'delete_user', 'title' => '删除用户', 'pid' => $manage_users->id]);


        // 节点权限
        $manage_nodes=Permission::create(['name' => 'manage_nodes', 'title' => '节点管理', 'path' => '/promise/nodes', 'is_menu' => 1]);
        Permission::create(['name' => 'create_update_node', 'title' => '添加修改节点', 'pid' => $manage_nodes->id]);
        Permission::create(['name' => 'delete_node', 'title' => '删除节点', 'pid' => $manage_nodes->id]);

        // 商户管理
        $merchant=Permission::create(['name' => 'manage_merchants', 'title' => '商户管理', 'path' => '/merchants', 'is_menu' => 1]);
        Permission::create(['name' => 'create_update_merchant', 'title' => '添加修改商户','pid'=>$merchant->id]);
        Permission::create(['name' => 'delete_merchant', 'title' => '删除商户','pid'=>$merchant->id]);

        //品牌设置
        $globalset=Permission::create(['name' => 'manage_globalset', 'title' => '通用设置', 'path' => '/globalset', 'is_menu' => 1]);
        $globalset_brands=Permission::create(['name' => 'manage_globalset_brands', 'title' => '品牌设置', 'path' => '/globalset/brand', 'is_menu' => 1,'pid'=>$globalset->id]);
        Permission::create(['name' => 'create_update_brand', 'title' => '添加修改品牌','pid'=>$globalset_brands->id]);
        Permission::create(['name' => 'delete_brand', 'title' => '删除品牌','pid'=>$globalset_brands->id]);
        $globalset_vins=Permission::create(['name' => 'manage_globalset_vins', 'title' => '车架号设置', 'path' => '/globalset/vin', 'is_menu' => 1]);
        Permission::create(['name' => 'create_update_vin', 'title' => '添加修改车架号','pid'=>$globalset_vins->id]);
        Permission::create(['name' => 'delete_vin', 'title' => '删除车架号','pid'=>$globalset_vins->id]);

        $globalset_companytypes=Permission::create(['name' => 'manage_globalset_companytypes', 'title' => '公司类型设置', 'path' => '/globalset/companytype', 'is_menu' => 1]);
        Permission::create(['name' => 'create_update_companytype', 'title' => '添加修改公司类型','pid'=>$globalset_companytypes->id]);
        Permission::create(['name' => 'delete_companytype', 'title' => '删除公司类型','pid'=>$globalset_companytypes->id]);

        $manage_actionlogs=Permission::create(['name' => 'manage_actionlogs', 'title' => '操作日志', 'path' => '/globalset/companytype', 'is_menu' => 1]);
        Permission::create(['name' => 'show_actionlog', 'title' => '查看日志','pid'=>$manage_actionlogs->id]);
        Permission::create(['name' => 'export_actionlog', 'title' => '导出日志','pid'=>$manage_actionlogs->id]);

        // 创建角色，并赋予权限
        $super = Role::create(['name' => 'super', 'title' => '超级管理员']);
        $super->givePermissionTo(['manage_permission','manage_roles','create_update_role','delete_role','manage_users','create_update_user','delete_user','manage_nodes','create_update_node','delete_node','manage_merchants','create_update_merchant','delete_merchant','manage_globalset','manage_globalset_brands','create_update_brand','delete_brand','manage_globalset_vins','create_update_vin','delete_vin','manage_globalset_companytypes','create_update_companytype','delete_companytype','manage_actionlogs','show_actionlog','export_actionlog']);

        // 创建管理员角色，并赋予权限
        $admin = Role::create(['name' => 'admin','title'=>'管理员']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        app()['cache']->forget('spatie.permission.cache');

        // 清空所有数据表数据
        $tableNames = config('permission.table_names');

        Model::unguard();
        DB::table($tableNames['role_has_permissions'])->delete();
        DB::table($tableNames['model_has_roles'])->delete();
        DB::table($tableNames['model_has_permissions'])->delete();
        DB::table($tableNames['roles'])->delete();
        DB::table($tableNames['permissions'])->delete();
        Model::reguard();
    }
}
