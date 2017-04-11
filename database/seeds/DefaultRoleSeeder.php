<?php

use Illuminate\Database\Seeder;
use Laratrust\LaratrustRole;

class DefaultRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        LaratrustRole::firstOrCreate([
            'slug' => 'admin',
            'name' => 'Admin',
            'description' => 'Admin Role',
            'level' => 9
        ]);
    }
}
