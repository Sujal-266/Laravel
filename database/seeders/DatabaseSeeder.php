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
        // Create users
        User::factory()
            ->count(10)
            ->create();

        // Create categories for each user
        User::all()->each(function ($user) {
            Category::factory()
                ->count(3)
                ->for($user)
                ->has(SubCategory::factory()->count(5), 'subCategories')
                ->create();
        });

        $users = User::all();
        Category::all()->each(function ($category) use ($users) {
            $category->likers()->sync($users->random(rand(1, 5))->pluck('id')->toArray());
        });
        SubCategory::all()->each(function ($subCategory) use ($users) {
            $subCategory->likers()->sync($users->random(rand(1, 5))->pluck('id')->toArray());
        });
    }
}
