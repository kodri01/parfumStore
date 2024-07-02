<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        User::query()->truncate();
        $admin = User::create([
            'name' => 'Administrator',
            'email' => 'admin@gmail.com',
            'gender' => '1',
            'password' => bcrypt('123123'),
            'role' => 1,
        ]);

        $seller = User::create([
            'name' => 'Seller',
            'email' => 'seller@gmail.com',
            'gender' => '1',
            'password' => bcrypt('123123'),
            'role' => 2,
        ]);

        $admin->assignRole('administrator');
        $seller->assignRole('seller');
    }
}