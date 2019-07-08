<?php

use Illuminate\Database\Seeder;
use App\User;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        User::create([
            'name'              => 'Huy Le',
            'email'             => 'lehuy333333@gmail.com',
            'password'          => Hash::make('asdasd'),
            'remember_token'    => str_random(10),
        ]);
    }
}
