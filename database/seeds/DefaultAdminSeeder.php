<?php

use Illuminate\Database\Seeder;
use App\User;

class DefaultAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::where('name', 'Sliverwing')->where('email', 'admin@sliverwing.me')->first();
        if (!$user)
        {
            $user = User::firstOrCreate([
                'name' => 'Sliverwing',
                'email' => 'admin@sliverwing.me',
                'password' =>  bcrypt('000000'),
            ]);
        }
        $adminRole = \App\Models\Role::where('name', 'admin')->firstOrFail();
        $user->attachRole($adminRole);
    }
}
