<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('categories')->insert([
            ['name' => 'تکنولوژی', 'slug' => 'tech', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'سبک زندگی ایرانی', 'slug' => 'sbk-zndgy-ayrany', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'سفر و گردشگری', 'slug' => 'travel', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}