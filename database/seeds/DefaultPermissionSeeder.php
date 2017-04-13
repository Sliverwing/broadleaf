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
            'slug' => 'admin.login',
            'name' => '管理员登陆',
            'description' => '管理员登陆',
        ]);
//        Permission
        $permission_index = Permission::firstOrCreate([
            'slug' => 'permission.index',
            'name' => '权限管理',
            'is_url_enabled' => true,
            'url' => '/admin/permission'
        ]);
        Permission::firstOrCreate([
            'slug' => 'permission.store',
            'name' => '保存权限',
        ]);
        Permission::firstOrCreate([
            'slug' => 'permission.create',
            'name' => '新建权限',
        ]);
        Permission::firstOrCreate([
            'slug' => 'permission.destroy',
            'name' => '删除权限',
        ]);
        Permission::firstOrCreate([
            'slug' => 'permission.update',
            'name' => '更新权限',
        ]);
        Permission::firstOrCreate([
            'slug' => 'permission.show',
            'name' => '显示权限详情',
        ]);
        Permission::firstOrCreate([
            'slug' => 'permission.edit',
            'name' => '编辑权限',
        ]);
        $this->parseBasicPermissionTable('role', '角色');
        $this->parseBasicPermissionTable('user', '用户');
        Permission::firstOrCreate([
            'slug' => 'user.role.edit',
            'name' => '用户组修改',
        ]);
    }

    public function parseBasicPermissionTable($slug , $name)
    {
        Permission::firstOrCreate([
            'slug' => $slug. '.index',
            'name' => $name . '管理',
            'is_url_enabled' => true,
            'url' => '/admin/' . $slug,
        ]);
        Permission::firstOrCreate([
            'slug' => $slug. '.store',
            'name' => '保存' . $name,
        ]);
        Permission::firstOrCreate([
            'slug' => $slug. '.create',
            'name' => '新建' . $name,
        ]);
        Permission::firstOrCreate([
            'slug' => $slug. '.destroy',
            'name' => '删除'. $name,
        ]);
        Permission::firstOrCreate([
            'slug' => $slug. '.update',
            'name' => '更新'. $name,
        ]);
        Permission::firstOrCreate([
            'slug' => $slug. '.show',
            'name' => '显示'. $name. '详情',
        ]);
        Permission::firstOrCreate([
            'slug' => $slug. '.edit',
            'name' => '编辑' . $name,
        ]);
    }
}
