<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'Sadegh biglar',
                'email' => 'sbmail555@gmail.com',
                'locale' => 'fa',
                'theme' => 'default',
                'email_verified_at' => null,
                'password' => Hash::make('password'),
                'two_factor_secret' => null,
                'two_factor_recovery_codes' => null,
                'two_factor_confirmed_at' => null,
                'remember_token' => null,
                'current_team_id' => null,
                'profile_photo_path' => null,
                'created_at' => now(),
                'updated_at' => now(),
                'is_admin' => 1,
            ],
            [
                'name' => 'Test User',
                'email' => 'test@example.com',
                'locale' => 'fa',
                'theme' => 'default',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'two_factor_secret' => null,
                'two_factor_recovery_codes' => null,
                'two_factor_confirmed_at' => null,
                'remember_token' => 'SNyx1T5vMC',
                'current_team_id' => null,
                'profile_photo_path' => null,
                'created_at' => now(),
                'updated_at' => now(),
                'is_admin' => 0,
            ],
            // سایر کاربران را اینجا اضافه کنید
        ]);
    }
}