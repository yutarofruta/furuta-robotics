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
        DB::table('users')->insert([
            'name' => 'AdminUser',
            'email' => 'adminuser@gmail.com',
            'password' => bcrypt('11111111'),
            'image' => '',
            'exp' => 0,
            'admin' => 1,
            'school' => 'A',
        ]);
        
    }
}
