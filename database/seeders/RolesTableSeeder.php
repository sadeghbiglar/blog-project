<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('roles')->insert([
            ['name' => 'admin', 'description' => 'مدیر کل', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'manager', 'description' => 'مدیر گروه', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'writer', 'description' => 'نویسنده', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'user', 'description' => 'کاربر عادی', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'writer_limit', 'description' => 'نویسنده محدود', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'manager_limit', 'description' => 'مدیر گروه محدود', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}