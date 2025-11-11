<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => ucfirst($this->faker->unique()->word()),
            'category_image' => $this->faker->imageUrl(640, 480, 'food', true, 'Category'),
            'user_id' => \App\Models\User::factory(),
        ];
    }
}
