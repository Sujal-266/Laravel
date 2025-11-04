<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\SubCategory;


class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       $categories = ['Food', 'Clothes', 'Electronics', 'Furniture'];

        foreach ($categories as $category) {
            Category::create(['name' => $category]);
        }
    }
}

