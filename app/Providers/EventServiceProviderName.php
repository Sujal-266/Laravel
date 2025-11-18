<?php

namespace App\Providers;

use App\Observers\CategoryObserver;
use App\Models\Category;
use Illuminate\Support\ServiceProvider;

class EventServiceProviderName extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Category::observe(CategoryObserver::class);
    }
}
