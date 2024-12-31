<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            ['name' => 'تکنولوژی', 'slug' => 'tech'],
            ['name' => 'سبک زندگی', 'slug' => 'lifestyle'],
            ['name' => 'سفر و گردشگری', 'slug' => 'travel'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
