<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    protected static $categories = [
        'Electronics', 'Fashion', 'Books', 'Furniture'
    ];

    protected static $index = 0;
    public function definition(): array
    {
        
        $name = self::$categories[self::$index % count(self::$categories)];
        self::$index++;

        return [
            'name' => $name,
        ];
    }
}
