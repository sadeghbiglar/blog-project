<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
/* 
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]); */
       // $this->call(PostSeeder::class);
        //  $this->call(CategorySeeder::class);
        $this->call([
            RolesTableSeeder::class,
            PermissionsTableSeeder::class,
            PermissionRoleTableSeeder::class,
            CategoriesTableSeeder::class,
            UsersTableSeeder::class,
            PostsTableSeeder::class,
            LikesTableSeeder::class,
            RoleUserTableSeeder::class,
            CommentsTableSeeder::class,
        ]);
    }
  
}
