<?php

namespace Database\Seeders;

use App\Models\Owner\TypeMakeup;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TypeMakeupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TypeMakeup::create([
            'name' => 'Wedding',
            'user_id' => 2,
        ]);

        TypeMakeup::create([
            'name' => 'Party',
            'user_id' => 2,
        ]);

        TypeMakeup::create([
            'name' => 'Photoshoot',
            'user_id' => 2,
        ]);

        TypeMakeup::create([
            'name' => 'Graduation',
            'user_id' => 2,
        ]);

        TypeMakeup::create([
            'name' => 'Engagement',
            'user_id' => 2,
        ]);
    }
}
