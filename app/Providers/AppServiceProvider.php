<?php

namespace App\Providers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\URL;
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
        // Enable HTTPS in production and staging environments
        if (env('APP_ENV') === 'production') {
            URL::forceScheme('https');
        }

        // Uncomment below to log database queries
        // DB::listen(function ($query) {
        //     Log::info("Query executed: {$query->sql} with bindings: " . json_encode($query->bindings));
        // });
    }
}
