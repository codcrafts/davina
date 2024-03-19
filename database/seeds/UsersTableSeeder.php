<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //admin
        \App\Models\User::create([
            'full_name'=>'Mohamed Elsaeed Mohamed',
            'user_name'=>'Mohamed Elsaeed ',
            'email'=>'admin@info.com',
            'is_verified'=>true,
            'password'=>'123456',
            'phone'=>'01288916154',
            'type'=>'admin'
        ]);
    }
}
