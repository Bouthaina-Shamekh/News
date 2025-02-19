<?php

namespace Database\Seeders;

use App\Models\AdPlace;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdPlaceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AdPlace::create([
            'name_en' => 'The right top ',
            'name_ar' => 'الجنب الاعلى يمينا',
        ]);
        AdPlace::create([
            'name_en' => 'The right bottom ',
            'name_ar' => 'الجنب الأسفل يمينا',
        ]);
        AdPlace::create([
            'name_en' => 'The left bottom ',
            'name_ar' => 'الجنب الأسفل يسارا',
        ]);
        AdPlace::create([
            'name_en' => 'The left top ',
            'name_ar' => 'الجنب الاعلى يمينا',
        ]);
        AdPlace::create([
            'name_en' => 'The center top',
            'name_ar' => 'الجنب المتوسط الأعلى',
        ]);
        AdPlace::create([
            'name_en' => 'The center bottom',
            'name_ar' => 'الجنب المتوسط الأسفل',
        ]);
    }
}
