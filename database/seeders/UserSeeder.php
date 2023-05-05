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
        $AdminUser = [
            [
                'name' => 'rifat',
                'email' => 'rifat@gmail.com',
                'phone' => '085745827142',
                'email_verified_at' => date('Y-m-d H:i:s', time()),
                'password' => \bcrypt('password'),
                'role_id' => 1
            ]
        ];

        User::insert($AdminUser);  //
    }
}
