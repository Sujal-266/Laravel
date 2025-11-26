<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        \Livewire\Livewire::component('test-component', \App\Http\Livewire\TestComponent::class);
        \Livewire\Livewire::component('category-list-component', \App\Http\Livewire\CategoryListComponent::class);
        \Livewire\Livewire::component('category-form-component', \App\Http\Livewire\CategoryFormComponent::class);
        \Livewire\Livewire::component('sub-category-list-component', \App\Http\Livewire\SubCategoryListComponent::class);
        \Livewire\Livewire::component('sub-category-form-component', \App\Http\Livewire\SubCategoryFormComponent::class);
    }
}
