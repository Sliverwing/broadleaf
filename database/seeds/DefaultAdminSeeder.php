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
       $user = User::firstOrCreate([
            'name' => 'Sliverwing',
            'email' => 'admin@sliverwing.me',
       ]);
       $user->password = bcrypt('000000');
       $user->save();

       $adminRole = \App\Models\Role::where('name', 'admin')->firstOrFail();
       $user->attachRole($adminRole);
    }
}
