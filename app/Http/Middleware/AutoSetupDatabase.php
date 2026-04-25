<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Cache;

class AutoSetupDatabase
{
    public function handle(Request $request, Closure $next)
    {
        if (Cache::has('db_setup_complete')) {
            return $next($request);
        }

        try {
            DB::connection()->getPdo();
            
            $needsMigration = !Schema::hasTable('users') || !Schema::hasTable('activity_reports');
            
            if ($needsMigration) {
                Artisan::call('migrate', ['--force' => true]);
            }
            
            $usersCount = DB::table('users')->count();
            $reportsCount = DB::table('activity_reports')->count();
            
            if ($usersCount === 0) {
                Artisan::call('db:seed', ['--class' => 'UserSeeder', '--force' => true]);
            }
            
            if ($reportsCount === 0) {
                Artisan::call('db:seed', ['--class' => 'ActivityReportSeeder', '--force' => true]);
            }
            
            Cache::put('db_setup_complete', true, 86400);
            
        } catch (\Exception $e) {
            \Log::error('Auto-setup failed: ' . $e->getMessage());
        }

        return $next($request);
    }
}
