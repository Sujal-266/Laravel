<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SubCategory;

class SubCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $subCategories = [
            ['parent_category_id' => 1, 'name' => 'Pizza'],
            ['parent_category_id' => 1, 'name' => 'Burger'],
            ['parent_category_id' => 2, 'name' => 'T-shirt'],
            ['parent_category_id' => 2, 'name' => 'Pants'],
            ['parent_category_id' => 3, 'name' => 'Mobile'],
            ['parent_category_id' => 3, 'name' => 'Television'],
        ];

        foreach ($subCategories as $subCategory) {
            SubCategory::create($subCategory);
        }
    }
    
}
