<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    protected $model = \App\Models\Post::class;

    public function definition()
    {
        return [
            'title' => $this->faker->sentence, // عنوان پست
            'content' => $this->faker->paragraphs(3, true), // محتوای پست
           // 'image' => null, // تصویر (در صورت نیاز می‌توان لینک نمونه اضافه کرد)
           'image' => $this->faker->imageUrl(640, 480, 'posts', true, 'sample'), // تصویر نمونه
            'user_id' => 1, // کاربر پیش‌فرض
        ];
    }
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
  
}
