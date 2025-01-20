<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('permissions')->insert([
            ['name' => 'create-user', 'description' => 'ایجاد کاربر', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'edit-user', 'description' => 'ویرایش کاربر', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'delete-user', 'description' => 'حذف کاربر', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'create-posts', 'description' => 'ایجاد پست', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'edit-posts', 'description' => 'ویرایش پست', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'delete-posts', 'description' => 'حذف پست', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'manage-posts', 'description' => 'مدیریت پست‌ها', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'manage-categories', 'description' => 'مدیریت دسته‌بندی‌ها', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'manage-comments', 'description' => 'مدیریت نظرات', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'manage-backup', 'description' => 'مدیریت بکاپ دیتابیس', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'manage-roles', 'description' => 'مدیریت نقش‌ها', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'manage-permisions', 'description' => 'مدیریت دسترسی‌ها', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'log_writer', 'description' => 'ثبت خطا', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}