<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Saudi Arabia cities
        $cities = [
            ['country_id' => 1, 'name' => 'الرياض', 'en_name' => 'Riyadh'],
            ['country_id' => 1, 'name' => 'جدة', 'en_name' => 'Jeddah'],
            ['country_id' => 1, 'name' => 'مكة المكرمة', 'en_name' => 'Mecca'],
            ['country_id' => 1, 'name' => 'المدينة المنورة', 'en_name' => 'Medina'],
            ['country_id' => 1, 'name' => 'الدمام', 'en_name' => 'Dammam'],
            ['country_id' => 1, 'name' => 'الطائف', 'en_name' => 'Taif'],
            ['country_id' => 1, 'name' => 'تبوك', 'en_name' => 'Tabuk'],
            ['country_id' => 1, 'name' => 'الخبر', 'en_name' => 'Al Khobar'],
            ['country_id' => 1, 'name' => 'بريدة', 'en_name' => 'Buraidah'],
            ['country_id' => 1, 'name' => 'ينبع', 'en_name' => 'Yanbu'],
        ];

        // Insert cities into the database
        foreach ($cities as $city) {
            DB::table('cities')->insert([
                'country_id' => $city['country_id'],
                'name' => $city['name'],
                'en_name' => $city['en_name'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
