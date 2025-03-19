<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CustomerAddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('customer_addresses')->insert([
            [
                'user_id' => 1, // Assuming user with ID 1 exists
                'country_id' => null, // Assuming country with ID 1 exists
                'city_id' => null, // Assuming city with ID 1 exists
                'neighbourhood_id' => null, // Assuming neighbourhood with ID 1 exists
                'location_lat' => '24.7136', // Example latitude for Riyadh
                'location_lanf' => '46.6753', // Example longitude for Riyadh
                'zip_code' => '12345',
                'address' => "123 King Abdulaziz Road, Riyadh, Saudi Arabia",
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 2, // Assuming user with ID 2 exists
                'country_id' => null, // Assuming country with ID 2 exists
                'city_id' => null, // Assuming city with ID 2 exists
                'neighbourhood_id' => null, // Assuming neighbourhood with ID 2 exists
                'location_lat' => '25.276987', // Example latitude for Dubai
                'location_lanf' => '55.296249', // Example longitude for Dubai
                'zip_code' => '54321',
                'address' => "456 Sheikh Zayed Road, Dubai, UAE",
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'user_id' => 3, // Assuming user with ID 2 exists
                'country_id' => null, // Assuming country with ID 2 exists
                'city_id' => null, // Assuming city with ID 2 exists
                'neighbourhood_id' => null, // Assuming neighbourhood with ID 2 exists
                'location_lat' => '25.276987', // Example latitude for Dubai
                'location_lanf' => '55.296249', // Example longitude for Dubai
                'zip_code' => '54321',
                'address' => "456 Sheikh Zayed Road, Dubai, UAE",
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
