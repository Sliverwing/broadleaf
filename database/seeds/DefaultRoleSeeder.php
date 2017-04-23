<?php

use Illuminate\Database\Seeder;
use Laratrust\LaratrustPermission;
use App\Models\Role;

class DefaultRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = Role::firstOrCreate([
            'slug' => 'admin',
            'name' => 'Admin',
            'description' => 'Admin Role',
            'level' => 9
        ]);
        $permissions = LaratrustPermission::all();
        $admin->syncPermissions($permissions);
    }
}
