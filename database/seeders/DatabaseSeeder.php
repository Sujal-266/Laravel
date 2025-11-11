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
        Category::factory()
            ->count(4)
            ->has(SubCategory::factory()->count(5), 'subCategories')
            ->create();

            User::factory()
                ->count(10)
                ->has(Category::factory()->count(2), 'categories')
                ->create();
        }   
    }
