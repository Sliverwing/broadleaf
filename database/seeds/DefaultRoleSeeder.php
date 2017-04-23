<?php

use Illuminate\Database\Seeder;
use Laratrust\LaratrustRole;
use Laratrust\LaratrustPermission;

class DefaultRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = LaratrustRole::firstOrCreate([
            'slug' => 'admin',
            'name' => 'Admin',
            'description' => 'Admin Role',
            'level' => 9
        ]);
        $permissions = LaratrustPermission::all();
        $admin->syncPermissions($permissions);
    }
}
