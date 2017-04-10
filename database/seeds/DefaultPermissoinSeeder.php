<?php

use Illuminate\Database\Seeder;
use App\Models\Permission;

class DefaultPermissoinSeeder extends Seeder
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
    }
}
