<?php

namespace Database\Seeders;

use App\Models\Instansi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InstansiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $instansi = [
            [
                'name' => 'VOKASI',
            ],
            [
                'name' => 'FIA',
            ],
            [
                'name' => 'FILKOM',
            ],
            [
                'name' => 'UKM',
            ],
        ];

        Instansi::insert($instansi);  //
    }
}
