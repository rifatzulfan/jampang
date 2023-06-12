<?php

namespace Database\Seeders;

use App\Models\Staff;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StaffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $staff = [
            [
                'name' => 'Wasit Atas',
                'price' => '50000',
                'description' => 'Wasit Pemimpin Pertandingan',
            ],
            [
                'name' => 'Wasit Atas + Wasit Bawah',
                'price' => '150000',
                'description' => 'Wasit Pemimpin Pertandingan',
            ],
          
        ];

        Staff::insert($staff);  //
    }
}
