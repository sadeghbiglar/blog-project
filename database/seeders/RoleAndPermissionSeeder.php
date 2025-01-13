<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\Permission;
class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
   
    public function run(): void
    {
        // نقش‌ها
        $admin = Role::create(['name' => 'admin', 'description' => 'مدیر کل']);
        $manager = Role::create(['name' => 'manager', 'description' => 'مدیر گروه']);
        $writer = Role::create(['name' => 'writer', 'description' => 'نویسنده']);
        $user = Role::create(['name' => 'user', 'description' => 'کاربر عادی']);

        // دسترسی‌ها
        $permissions = [
            'create_user',
            'edit_user',
            'delete_user',
            'create_post',
            'edit_post',
            'delete_post',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission, 'description' => $permission]);
        }

        // تخصیص دسترسی‌ها به نقش‌ها
        $admin->permissions()->attach(Permission::all());
    }

}
