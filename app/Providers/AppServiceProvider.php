<?php

namespace App\Providers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;
use App\Models\Registration;
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
        // Enable HTTPS in production and staging environments
        if (env('APP_ENV') === 'production') {
            URL::forceScheme('https');
        }
        
        DB::listen(function ($query) {
            Log::info("Query executed: {$query->sql} with bindings: " . json_encode($query->bindings));
        });
        // Share the pending registration count with all views
        View::composer('*', function ($view) {
            $pendingCount = Registration::where('status', 'pending')->count();
            $view->with('pendingCount', $pendingCount);
        });
    }
}
