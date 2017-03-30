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
            'name' => 'admin',
            'display_name' => 'Admin',
            'description' => 'Admin Role'
        ]);
    }
}
