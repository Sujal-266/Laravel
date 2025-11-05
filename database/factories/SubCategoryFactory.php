<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Category;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SubCategory>
 */
class SubCategoryFactory extends Factory
{
     protected static $index = 1;
    public function definition(): array
    {
        $subNames = [
            'Mobiles', 'Laptops', 'Headphones', 'Smartwatches', 'Cameras',
            'Shirts', 'Pants', 'Shoes', 'Watches', 'Bags',
            'Fiction', 'Comics', 'Novels', 'Magazines', 'Journals',
            'Sofas', 'Tables', 'Chairs', 'Beds', 'Cupboards'
        ];

        return [
            'name' => $subNames[self::$index++ - 1] ?? $this->faker->word(),
            'parent_category_id' => null, // will be set in seeder
        ];
    }
}
