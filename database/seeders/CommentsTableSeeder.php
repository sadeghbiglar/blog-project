<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CommentsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('comments')->insert([
            [
                'post_id' => 28,
                'user_id' => 1,
                'content' => 'نظر تست',
                'created_at' => now(),
                'updated_at' => now(),
                'approved' => 1,
            ],
        ]);
    }
}