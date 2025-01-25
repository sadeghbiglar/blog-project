<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LikesTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('likes')->insert([
            ['post_id' => 25, 'user_id' => 1, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}