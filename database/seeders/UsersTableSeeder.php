<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $roleSuperAdmin = Role::firstOrCreate(['name' => 'Super Admin']);
        DB::table('users')->insert([
            [
                'first_name'   => 'Hani',
                'last_name'    => 'Yosuif',
                'phone_number' => '96653509129',
                'email'        => 'haniusif@gmail.com',
                'password'     => Hash::make('12345678'),
                'created_at'   => now(),
                'updated_at'   => now(),
                'user_type'    => 'admin',
            ],
            [
                'first_name'   => 'Admin',
                'last_name'    => 'Feeri',
                'phone_number' => '0096653509129',
                'email'        => 'admin@feeri.io',
                'password'     => Hash::make('12345678'),
                'created_at'   => now(),
                'updated_at'   => now(),
                'user_type'    => 'admin',
            ],

            [
                'first_name'   => 'Eyad',
                'last_name'    => 'Hani',
                'phone_number' => '053509129',
                'email'        => 'eyadhaniusif@feeri.io',
                'password'     => Hash::make('12345678'),
                'created_at'   => now(),
                'updated_at'   => now(),
                'user_type'    => 'user',
            ],
        ]);

        $userHani  = \App\Models\User::where('email', 'haniusif@gmail.com')->first();
        $userAdmin = \App\Models\User::where('email', 'admin@feeri.io')->first();

        $userHani->assignRole('Super Admin');
        $userAdmin->assignRole('Super Admin');
    }
}
