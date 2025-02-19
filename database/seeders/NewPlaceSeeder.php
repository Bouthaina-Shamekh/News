<?php

namespace Database\Seeders;

use App\Models\NewPlace;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NewPlaceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        NewPlace::create([
            'name_en' => 'sliders',
            'name_ar' => 'السلايدر',
        ]);
    }
}
