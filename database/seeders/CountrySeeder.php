<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Insert Saudi Arabia into the countries table
        DB::table('countries')->insert([
            'name' => 'السعودية', // Arabic name
            'en_name' => 'Saudi Arabia', // English name
            'iso_code' => 'SA', // ISO 3166-1 alpha-2 code
            'country_code' => '+966', // Country code
            'created_at' => now(), // Current timestamp
            'updated_at' => now(),
        ]);
    }
}
