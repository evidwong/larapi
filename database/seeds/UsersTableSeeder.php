<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create(['name' => '超级管理员', 'email' => 'super@super.com', 'password' => bcrypt('123456')]);
        $user->assignRole('super');
    }
}
