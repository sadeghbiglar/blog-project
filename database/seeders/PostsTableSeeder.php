<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('posts')->insert([
            [
                'category_id' => 1,
                'title' => 'پست تستی اول',
                'content' => 'متن پست تستی اول',
                'image' => 'posts/1r2zuzOOKMj8O5ww0ZZtBYJ2UKmhuFaUM6TEGzRv.jpg',
                'created_at' => now(),
                'updated_at' => now(),
                'file' => null,
                'views' => 0,
                'user_id' => 1,
            ],
            [
                'category_id' => 2,
                'title' => 'پست تستی دوم',
                'content' => 'متن پست تستی دوم',
                'image' => 'posts/1r2zuzOOKMj8O5ww0ZZtBYJ2UKmhuFaUM6TEGzRv.jpg',
                'created_at' => now(),
                'updated_at' => now(),
                'file' => null,
                'views' => 0,
                'user_id' => 1,
            ],
            // سایر پست‌ها را اینجا اضافه کنید
        ]);
    }
}