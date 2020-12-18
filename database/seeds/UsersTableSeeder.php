<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users_array = array(
        array(
            'name' => 'Nabina',
            'email' => 'nabina@emporium.com',
            'password' => Hash::make('nabina123'),
            'status' => 'active',
            'role' => 'user'
        ),
        array(
            'name' => 'Seller',
            'email' => 'seller@emporium.com',
            'password' => Hash::make('seller123'),
            'status' => 'active',
            'role' => 'seller'
        ),

        array(
            'name' => 'Customer',
            'email' => 'customer@emporium.com',
            'password' => Hash::make('customer123'),
            'status' => 'active',
            'role' => 'customer'
        ),
    );
        DB::table('users')->insert($users_array);
    }
}
