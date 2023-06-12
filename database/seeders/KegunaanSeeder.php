<?php

namespace Database\Seeders;

use App\Models\Kegunaan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KegunaanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $kegunaan = [
            [
                'name' => 'Latihan Voli',
            ],
            [
                'name' => 'Samba',
            ],
            [
                'name' => 'Marching Band',
            ],
            
        ];

        Kegunaan::insert($kegunaan);  //
    }
}
