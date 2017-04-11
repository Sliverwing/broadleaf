<?php

use Illuminate\Database\Seeder;
use App\Models\Permission;

class DefaultPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::firstOrCreate([
            'name' => 'admin.login',
            'display_name' => '管理员登陆',
            'description' => '管理员登陆',
        ]);
//        Permission
        $permission_index = Permission::firstOrCreate([
            'name' => 'permission.index',
            'display_name' => '权限管理',
            'is_url_enabled' => true,
            'url' => '/admin/permission'
        ]);
        Permission::firstOrCreate([
            'name' => 'permission.store',
            'display_name' => '保存权限',
        ]);
        Permission::firstOrCreate([
            'name' => 'permission.create',
            'display_name' => '新建权限',
        ]);
        Permission::firstOrCreate([
            'name' => 'permission.destroy',
            'display_name' => '删除权限',
        ]);
        Permission::firstOrCreate([
            'name' => 'permission.update',
            'display_name' => '更新权限',
        ]);
        Permission::firstOrCreate([
            'name' => 'permission.show',
            'display_name' => '显示权限详情',
        ]);
        Permission::firstOrCreate([
            'name' => 'permission.edit',
            'display_name' => '编辑权限',
        ]);


    }
}
