<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;

try {
    DB::connection()->getPdo();
    echo "✓ Database connected\n";
    
    // Check if migrations are needed
    $needsMigration = !Schema::hasTable('users') || !Schema::hasTable('activity_reports');
    
    if ($needsMigration) {
        echo "→ Running migrations...\n";
        Artisan::call('migrate', ['--force' => true]);
        echo "✓ Migrations completed\n";
    } else {
        echo "✓ Tables already exist\n";
    }
    
    // Check if seeding is needed
    $usersCount = DB::table('users')->count();
    $reportsCount = DB::table('activity_reports')->count();
    
    if ($usersCount === 0) {
        echo "→ Seeding users...\n";
        Artisan::call('db:seed', ['--class' => 'UserSeeder', '--force' => true]);
        echo "✓ Users seeded\n";
    } else {
        echo "✓ Users already exist ($usersCount records)\n";
    }
    
    if ($reportsCount === 0) {
        echo "→ Seeding activity reports...\n";
        Artisan::call('db:seed', ['--class' => 'ActivityReportSeeder', '--force' => true]);
        echo "✓ Activity reports seeded\n";
    } else {
        echo "✓ Activity reports already exist ($reportsCount records)\n";
    }
    
    echo "\n✓ Setup complete!\n";
    
} catch (Exception $e) {
    echo "✗ Error: " . $e->getMessage() . "\n";
    exit(1);
}
