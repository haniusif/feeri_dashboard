<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('banks')->insert([
            ['name' => 'البنك الأهلي السعودي', 'en_name' => 'Saudi National Bank'],
            ['name' => 'مصرف الراجحي', 'en_name' => 'Al Rajhi Bank'],
            ['name' => 'بنك الرياض', 'en_name' => 'Riyad Bank'],
            ['name' => 'بنك ساب', 'en_name' => 'SAB Bank'],
            ['name' => 'البنك العربي الوطني', 'en_name' => 'Arab National Bank'],
            ['name' => 'مصرف الإنماء', 'en_name' => 'Alinma Bank'],
            ['name' => 'البنك السعودي الفرنسي', 'en_name' => 'Banque Saudi Fransi'],
            ['name' => 'البنك السعودي للاستثمار', 'en_name' => 'Saudi Investment Bank'],
            ['name' => 'بنك الجزيرة', 'en_name' => 'Bank AlJazira'],
            ['name' => 'بنك البلاد', 'en_name' => 'Bank Albilad'],
            ['name' => 'بنك الخليج الدولي', 'en_name' => 'Gulf International Bank'],
        ]);
    }
}
