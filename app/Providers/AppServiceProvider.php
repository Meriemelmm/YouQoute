<?php

namespace App\Providers;

use App\Models\Category;
use Illuminate\Support\ServiceProvider;
use App\Models\Citation;
use App\Policies\CategoryPolicy;
use App\Policies\CitationPolicy;
use Illuminate\Support\Facades\Gate;

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
        
         Gate::policy(Citation::class, CitationPolicy::class);
        Gate::policy(Category::class, CategoryPolicy::class);
    }
}
