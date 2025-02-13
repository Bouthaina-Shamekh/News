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
            ['key' => 'linkedin', 'value' => 'https://www.linkedin.com/in/your-profile'],
            ['key' => 'instagram', 'value' => 'https://www.instagram.com/your-profile'],
            ['key' => 'twitter', 'value' => 'https://twitter.com/your-profile'],
            ['key' => 'facebook', 'value' => 'https://www.facebook.com/your-profile'],
            ['key' => 'snapshat', 'value' => 'https://www.snapchat.com/add/your-profile'],
            ['key' => 'whatsapp', 'value' => 'https://wa.me/your-phone-number'],
            ['key' => 'titel_en', 'value' => 'Lorem Ipsum Dolor Sit Amet, Consetetur Sadipscing Elitr, Sed Diam Nonumy Eirmod Tempor Invidunt Ut Labore Et Dolore Magna Aliquyam Erat, Sed Diam Voluptua. At Vero Eos Et Accusam Et Justo Duo'],
            ['key' => 'titel_ar', 'value' => ' Lorem Ipsum Dolor Sit Amet, Consetetur Sadipscing Elitr, Sed Diam Nonumy Eirmod Tempor Invidunt Ut Labore Et Dolore Magna Aliquyam Erat, Sed Diam Voluptua. At Vero Eos Et Accusam Et Justo Duo'],
            ['key' => 'logo', 'value' => 'public/logos/public/uploads/logos/1733230449.png'],
            ['key' => 'contact_email', 'value' => 'info@yourdomain.com'],
            ['key' => 'currency', 'value' => 'USD'],
            ['key' => 'policy_ar', 'value' => 'سياسة الخصوصية بالعربية'],
            ['key' => 'policy_en', 'value' => 'Privacy Policy in English']
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
