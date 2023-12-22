<?php

namespace Database\Seeders;

use App\Models\Owner\DetailMakeup;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DetailMakeupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DetailMakeup::create([
            'id_makeup' => '1',
            'id_type_makeup' => '1',
        ]);
        DetailMakeup::create([
            'id_makeup' => '1',
            'id_type_makeup' => '2',
        ]);
        DetailMakeup::create([
            'id_makeup' => '2',
            'id_type_makeup' => '1',
        ]);
        DetailMakeup::create([
            'id_makeup' => '2',
            'id_type_makeup' => '2',
        ]);
        DetailMakeup::create([
            'id_makeup' => '3',
            'id_type_makeup' => '1',
        ]);
        DetailMakeup::create([
            'id_makeup' => '3',
            'id_type_makeup' => '2',
        ]);
        DetailMakeup::create([
            'id_makeup' => '4',
            'id_type_makeup' => '5',
        ]);
        DetailMakeup::create([
            'id_makeup' => '4',
            'id_type_makeup' => '2',
        ]);
    }
}
