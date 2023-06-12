<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $User = [
            [
                'name' => 'rifat',
                'email' => 'rifat@gmail.com',
                'phone' => '085745827142',
                'email_verified_at' => date('Y-m-d H:i:s', time()),
                'password' => \bcrypt('password'),
                'role' => 'Superadmin'
            ],
            [
                'name' => 'Alexis MacAlisster',
                'email' => 'mac@gmail.com',
                'phone' => '081390220345',
                'email_verified_at' => date('Y-m-d H:i:s', time()),
                'password' => \bcrypt('password'),
                'role' => 'User'
            ],
        ];

        User::insert($User);  //
    }
}
