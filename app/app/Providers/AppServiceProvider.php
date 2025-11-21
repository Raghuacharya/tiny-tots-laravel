<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

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
        // Share version variable with all views
        $version = null;
        if (file_exists(base_path('VERSION'))) {
            $version = trim(file_get_contents(base_path('VERSION')));
        }
        View::share('appVersion', $version);
    }
}
