<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Category;
use App\Models\User;
use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $user = Admin::create([
            'name' => 'Administrator',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admain'),
            'avatar' => 'default.png',
        ]);

        Category::create([
            'name_en' => 'category-test',
            'name_ar' => 'تصنيف اختياري',
            'slug' => 'category-test',
            'image' => null,
            'created_by' => 1,
        ]);

        $this->call(UsersTableSeeder::class);
        $this->call(SettingsTableSeeder::class);
        $this->call(AboutSeeder::class);
        $this->call(NewPlaceSeeder::class);
        $this->call(StatuSeeder::class);
        $this->call(AdPlaceSeeder::class);
    }
}
