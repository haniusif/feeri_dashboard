<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        


        DB::table('order_statuses')->insert([
            [
                'name' => 'قيد الانتظار', // Arabic for Pending
                'en_name' => 'Pending',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'قيد التنفيذ', // Arabic for In Progress
                'en_name' => 'In Progress',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'تم التوصيل', // Arabic for Delivered
                'en_name' => 'Delivered',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'ملغى', // Arabic for Cancelled
                'en_name' => 'Cancelled',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'مرتجع', // Arabic for Returned
                'en_name' => 'Returned',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'فشل التسليم', // Arabic for Delivery Failed
                'en_name' => 'Delivery Failed',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'معلق', // Arabic for On Hold
                'en_name' => 'On Hold',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'قيد الشحن', // Arabic for In Transit
                'en_name' => 'In Transit',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
        

    }
}
