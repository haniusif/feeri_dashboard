<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NeighbourhoodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Define neighbourhoods for each city
        $neighbourhoods = [
            // Riyadh (City ID: 1)
            1 => [
                ['name' => 'الملز', 'en_name' => 'Al Malaz'],
                ['name' => 'النخيل', 'en_name' => 'Al Nakheel'],
                ['name' => 'السليمانية', 'en_name' => 'As Sulimaniyah'],
                ['name' => 'العليا', 'en_name' => 'Al Olaya'],
                ['name' => 'النسيم', 'en_name' => 'An Naseem'],
            ],

            // Jeddah (City ID: 2)
            2 => [
                ['name' => 'السلامة', 'en_name' => 'Al Salamah'],
                ['name' => 'البساتين', 'en_name' => 'Al Basateen'],
                ['name' => 'الشاطئ', 'en_name' => 'Ash Shati'],
                ['name' => 'الروضة', 'en_name' => 'Ar Rawdah'],
                ['name' => 'الحمراء', 'en_name' => 'Al Hamra'],
            ],

            // Mecca (City ID: 3)
            3 => [
                ['name' => 'العزيزية', 'en_name' => 'Al Aziziyah'],
                ['name' => 'النوارية', 'en_name' => 'An Nawariyah'],
                ['name' => 'المسفلة', 'en_name' => 'Al Misfalah'],
                ['name' => 'الشرائع', 'en_name' => 'Ash Sharaie'],
                ['name' => 'الكعكية', 'en_name' => 'Al Kakiyyah'],
            ],

            // Medina (City ID: 4)
            4 => [
                ['name' => 'القباء', 'en_name' => 'Al Quba'],
                ['name' => 'العزيزية', 'en_name' => 'Al Aziziyah'],
                ['name' => 'الحرة الشرقية', 'en_name' => 'Al Harrah Al Sharqiyah'],
                ['name' => 'الخالدية', 'en_name' => 'Al Khalidiyyah'],
                ['name' => 'الفيصلية', 'en_name' => 'Al Faisaliyah'],
            ],

            // Dammam (City ID: 5)
            5 => [
                ['name' => 'المزروعية', 'en_name' => 'Al Mazrouiah'],
                ['name' => 'النخيل', 'en_name' => 'Al Nakheel'],
                ['name' => 'البديع', 'en_name' => 'Al Badiyah'],
                ['name' => 'العدامة', 'en_name' => 'Al Adama'],
                ['name' => 'الشاطئ الغربي', 'en_name' => 'Al Shati Al Gharbi'],
            ],

            // Yanbu (City ID: 6)
            6 => [
                ['name' => 'الموقف', 'en_name' => 'Al Muwakfa'],
                ['name' => 'الشريعات', 'en_name' => 'Ash Sharei\'at'],
                ['name' => 'الشوقية', 'en_name' => 'Ash Shuqiya'],
                ['name' => 'العكيشية', 'en_name' => 'Al Akishiya'],
                ['name' => 'البغدادية', 'en_name' => 'Al Baghdadiyah'],
            ],

            // Buraidah (City ID: 7)
            7 => [
                ['name' => 'الاسياح', 'en_name' => 'As Sihah'],
                ['name' => 'النبهانية', 'en_name' => 'An Nabhaniah'],
                ['name' => 'الرس', 'en_name' => 'Ar Rass'],
                ['name' => 'البريكة', 'en_name' => 'Al Buraykah'],
                ['name' => 'القاعد', 'en_name' => 'Al Qa\'id'],
            ],

            // Al Khobar (City ID: 8)
            8 => [
                ['name' => 'المروج', 'en_name' => 'Al Muruj'],
                ['name' => 'الخالدية', 'en_name' => 'Al Khalidiyah'],
                ['name' => 'الدمام', 'en_name' => 'Dammam'],
                ['name' => 'الصحيفة', 'en_name' => 'Ash Sha\'ifah'],
                ['name' => 'الندى', 'en_name' => 'Al Nada'],
            ],

            // Tabuk (City ID: 9)
            9 => [
                ['name' => 'الناصرية', 'en_name' => 'An Nasiriya'],
                ['name' => 'الحميدية', 'en_name' => 'Al Hamidiya'],
                ['name' => 'الحمراء', 'en_name' => 'Al Hamra'],
                ['name' => 'الورود', 'en_name' => 'Al Wurood'],
                ['name' => 'الزهراء', 'en_name' => 'Al Zahra'],
            ],

            // Taif (City ID: 10)
            10 => [
                ['name' => 'الشفا', 'en_name' => 'Ash Shafa'],
                ['name' => 'الفيصلية', 'en_name' => 'Al Faisaliyah'],
                ['name' => 'الضيافة', 'en_name' => 'Ad Dayafa'],
                ['name' => 'النزهة', 'en_name' => 'An Nuzhah'],
                ['name' => 'الجبرية', 'en_name' => 'Al Jabriyyah'],
            ],
        ];

        // Insert neighbourhoods into the database
        foreach ($neighbourhoods as $city_id => $city_neighbourhoods) {
            foreach ($city_neighbourhoods as $neighbourhood) {
                DB::table('neighbourhoods')->insert([
                    'city_id' => $city_id,
                    'name' => $neighbourhood['name'],
                    'en_name' => $neighbourhood['en_name'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
