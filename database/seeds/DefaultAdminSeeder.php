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
       User::firstOrCreate([
            'name' => 'Sliverwing',
            'email' => 'admin@sliverwing.me',
            'password' => bcrypt('000000')
       ]);
    }
}
