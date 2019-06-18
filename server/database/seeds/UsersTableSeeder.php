<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();

        DB::table('users')->insert([
            'email' => 'caleboki@gmail.com',
            'password' => bcrypt('password123'),
            'api_token' => str_random(60),

        ]);
    }
}
