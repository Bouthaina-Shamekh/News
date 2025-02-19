<?php

namespace Database\Seeders;

use App\Models\Statu;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Statu::create([
            'name_en' => 'breaking_news',
            'name_ar' => 'أخبار عاجلة',
        ]);

        Statu::create([
            'name_en' => 'latest_news',
            'name_ar' => 'أحدث الأخبار',
        ]);

        Statu::create([
            'name_en' => 'most_viewed',
            'name_ar' => 'الأكثر مشاهدة',
        ]);
    }
}
