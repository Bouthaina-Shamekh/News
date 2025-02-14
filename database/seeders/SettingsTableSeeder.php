<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [

            ['key' => 'site_ar', 'value' => 'مارينا بوست'],
            ['key' => 'site_en', 'value' => 'Marena post'],
            ['key' => 'instagram', 'value' => 'https://www.instagram.com/mrynbwst/?hl=ar'],
            ['key' => 'facebook', 'value' => 'https://www.facebook.com/marena.post.news?locale=ar_AR'],
            ['key' => 'youtube', 'value' => 'https://www.youtube.com/@marenapost'],
            ['key' => 'phone', 'value' => '000000'],
            ['key' => 'contact_email', 'value' => 'info@marenapost.com'],
            ['key' => 'titel_en', 'value' => 'Palestine'],
            ['key' => 'titel_ar', 'value' => 'فلسطين'],
            ['key' => 'about_en', 'value' => 'The best news and articles. Learn about the latest news with high credibility. You can find the latest news on trending areas and more right here.'],
            ['key' => 'about_ar', 'value' => ' افضل الأخبار والمقالات.  تعرف على احدث الأخبار بمصداقية عالية. يمكنك الاطّلاع على آخر الأخبار المتعلّقة بالمجالات الرائجة والمزيد من هنا مباشرةً.'],
            ['key' => 'logo', 'value' => 'public/uploads/logos/marina.png'],

           

            ['key' => 'logo_icon', 'value' => 'public/uploads/logos/logos.png'],
        ];

        // Insert data into the settings table
        foreach ($settings as $setting) {
            DB::table('settings')->updateOrInsert(
                ['key' => $setting['key']],
                ['value' => $setting['value']] 
            );
        }

    }
}
