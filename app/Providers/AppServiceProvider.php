<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Artisan;

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
        Schema::defaultStringLength(191);
        
        if (config('app.env') === 'local') {
            try {
                if (!Schema::hasTable('users')) {
                    Artisan::call('migrate', ['--force' => true]);
                    Artisan::call('db:seed', ['--force' => true]);
                }
            } catch (\Exception $e) {
                // Silently fail if database not ready
            }
        }
    }
}
