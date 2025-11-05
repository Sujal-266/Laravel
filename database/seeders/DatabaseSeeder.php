<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;



class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $categories = Category::factory(4)->create();

        $subNames = [
            // Electronics
            ['Mobiles', 'Laptops', 'Headphones', 'Smartwatches', 'Cameras'],
            // Fashion
            ['Shirts', 'Pants', 'Shoes', 'Watches', 'Bags'],
            // Books
            ['Fiction', 'Comics', 'Novels', 'Magazines', 'Journals'],
            // Furniture
            ['Sofas', 'Tables', 'Chairs', 'Beds', 'Cupboards'],
        ];

        foreach ($categories as $index => $category) {
            foreach ($subNames[$index] as $sub) {
                SubCategory::create([
                    'name' => $sub,
                    'parent_category_id' => $category->id,
                ]);
            }
        }       
    }
}
