<?php
/**
 * EMERGENCY DIAGNOSTIC SCRIPT
 * Run this to find out why registration stopped working
 * 
 * Usage: php emergency-diagnostic.php
 */

echo "╔════════════════════════════════════════════════════════════╗\n";
echo "║     PATHFIT EMERGENCY DIAGNOSTIC - REGISTRATION FAILURE    ║\n";
echo "╚════════════════════════════════════════════════════════════╝\n\n";

// Load Laravel
try {
    require __DIR__.'/vendor/autoload.php';
    $app = require_once __DIR__.'/bootstrap/app.php';
    $kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
    $kernel->bootstrap();
    echo "✓ Laravel loaded successfully\n\n";
} catch (Exception $e) {
    echo "✗ CRITICAL: Failed to load Laravel\n";
    echo "  Error: " . $e->getMessage() . "\n\n";
    exit(1);
}

echo "═══════════════════════════════════════════════════════════\n";
echo "1. CHECKING DATABASE CONNECTION\n";
echo "═══════════════════════════════════════════════════════════\n";

try {
    $pdo = DB::connection()->getPdo();
    echo "✓ Database connection: SUCCESS\n";
    echo "  Driver: " . DB::connection()->getDriverName() . "\n";
    echo "  Database: " . DB::connection()->getDatabaseName() . "\n";
    
    $config = config('database.connections.mysql');
    echo "  Host: " . $config['host'] . "\n";
    echo "  Port: " . $config['port'] . "\n";
    echo "  Username: " . $config['username'] . "\n\n";
} catch (Exception $e) {
    echo "✗ CRITICAL: Database connection FAILED\n";
    echo "  Error: " . $e->getMessage() . "\n\n";
    echo "SOLUTION: Check your database credentials in .env file\n\n";
    exit(1);
}

echo "═══════════════════════════════════════════════════════════\n";
echo "2. CHECKING USERS TABLE\n";
echo "═══════════════════════════════════════════════════════════\n";

try {
    $tableExists = Schema::hasTable('users');
    if (!$tableExists) {
        echo "✗ CRITICAL: Users table does NOT exist!\n";
        echo "SOLUTION: Run migrations: php artisan migrate\n\n";
        exit(1);
    }
    echo "✓ Users table exists\n";
    
    // Check required columns
    $requiredColumns = ['id', 'name', 'email', 'password', 'fname', 'lname', 'course', 'gender', 'role'];
    $missingColumns = [];
    
    foreach ($requiredColumns as $column) {
        if (!Schema::hasColumn('users', $column)) {
            $missingColumns[] = $column;
        }
    }
    
    if (count($missingColumns) > 0) {
        echo "✗ CRITICAL: Missing columns: " . implode(', ', $missingColumns) . "\n";
        echo "SOLUTION: Run migrations: php artisan migrate\n\n";
        exit(1);
    }
    echo "✓ All required columns exist\n";
    
    // Check current user count
    $userCount = DB::table('users')->count();
    echo "✓ Current users in database: " . $userCount . "\n\n";
    
} catch (Exception $e) {
    echo "✗ Error checking users table: " . $e->getMessage() . "\n\n";
    exit(1);
}

echo "═══════════════════════════════════════════════════════════\n";
echo "3. TESTING USER CREATION\n";
echo "═══════════════════════════════════════════════════════════\n";

try {
    $testEmail = 'diagnostic_test_' . time() . '@example.com';
    
    echo "Attempting to create test user...\n";
    echo "  Email: " . $testEmail . "\n";
    
    // Try using the User model (same as registration)
    $user = App\Models\User::create([
        'name' => 'Diagnostic Test User',
        'fname' => 'Diagnostic',
        'mname' => 'Test',
        'lname' => 'User',
        'course' => 'Test Course',
        'gender' => 'male',
        'email' => $testEmail,
        'password' => Hash::make('password123'),
        'role' => 'Athlete',
        'email_verified_at' => now(),
    ]);
    
    echo "✓ User created successfully!\n";
    echo "  User ID: " . $user->id . "\n";
    echo "  Name: " . $user->name . "\n";
    echo "  Email: " . $user->email . "\n";
    
    // Verify user was actually saved
    $savedUser = DB::table('users')->where('email', $testEmail)->first();
    if ($savedUser) {
        echo "✓ User verified in database\n";
    } else {
        echo "✗ WARNING: User created but not found in database!\n";
    }
    
    // Clean up
    $user->delete();
    echo "✓ Test user deleted (cleanup)\n\n";
    
    echo "═══════════════════════════════════════════════════════════\n";
    echo "RESULT: User creation is WORKING!\n";
    echo "═══════════════════════════════════════════════════════════\n\n";
    
} catch (Exception $e) {
    echo "✗ CRITICAL: User creation FAILED!\n";
    echo "  Error: " . $e->getMessage() . "\n";
    echo "  Type: " . get_class($e) . "\n\n";
    
    if (strpos($e->getMessage(), 'Duplicate entry') !== false) {
        echo "CAUSE: Email already exists in database\n";
        echo "SOLUTION: This is normal - use unique emails\n\n";
    } elseif (strpos($e->getMessage(), 'Unknown column') !== false) {
        echo "CAUSE: Missing database column\n";
        echo "SOLUTION: Run migrations: php artisan migrate\n\n";
    } elseif (strpos($e->getMessage(), 'Connection') !== false) {
        echo "CAUSE: Database connection lost\n";
        echo "SOLUTION: Check database server is running\n\n";
    } else {
        echo "Stack trace:\n";
        echo $e->getTraceAsString() . "\n\n";
    }
    exit(1);
}

echo "═══════════════════════════════════════════════════════════\n";
echo "4. CHECKING RAILWAY DATABASE CONFIGURATION\n";
echo "═══════════════════════════════════════════════════════════\n";

$expectedHost = 'shuttle.proxy.rlwy.net';
$expectedPort = '10519';
$expectedDatabase = 'railway';

$actualHost = config('database.connections.mysql.host');
$actualPort = config('database.connections.mysql.port');
$actualDatabase = config('database.connections.mysql.database');

echo "Expected Railway Configuration:\n";
echo "  Host: " . $expectedHost . "\n";
echo "  Port: " . $expectedPort . "\n";
echo "  Database: " . $expectedDatabase . "\n\n";

echo "Current Configuration:\n";
echo "  Host: " . $actualHost . "\n";
echo "  Port: " . $actualPort . "\n";
echo "  Database: " . $actualDatabase . "\n\n";

if ($actualHost === $expectedHost && $actualPort == $expectedPort && $actualDatabase === $expectedDatabase) {
    echo "✓ Using correct Railway database\n\n";
} else {
    echo "⚠ WARNING: Not using Railway database!\n";
    echo "This might be intentional if testing locally.\n\n";
}

echo "═══════════════════════════════════════════════════════════\n";
echo "5. CHECKING RECENT ERRORS IN LOG\n";
echo "═══════════════════════════════════════════════════════════\n";

$logFile = storage_path('logs/laravel.log');
if (file_exists($logFile)) {
    $logContent = file_get_contents($logFile);
    $lines = explode("\n", $logContent);
    $recentErrors = array_slice(array_reverse($lines), 0, 20);
    
    $hasErrors = false;
    foreach ($recentErrors as $line) {
        if (stripos($line, 'error') !== false || stripos($line, 'exception') !== false) {
            echo $line . "\n";
            $hasErrors = true;
        }
    }
    
    if (!$hasErrors) {
        echo "✓ No recent errors found in log\n\n";
    } else {
        echo "\n";
    }
} else {
    echo "⚠ Log file not found: " . $logFile . "\n\n";
}

echo "═══════════════════════════════════════════════════════════\n";
echo "6. CHECKING ENVIRONMENT\n";
echo "═══════════════════════════════════════════════════════════\n";

echo "APP_ENV: " . config('app.env') . "\n";
echo "APP_DEBUG: " . (config('app.debug') ? 'true' : 'false') . "\n";
echo "APP_KEY: " . (config('app.key') ? 'SET' : 'NOT SET') . "\n";
echo "SESSION_DRIVER: " . config('session.driver') . "\n";
echo "CACHE_DRIVER: " . config('cache.default') . "\n\n";

if (!config('app.key')) {
    echo "✗ WARNING: APP_KEY is not set!\n";
    echo "SOLUTION: Run: php artisan key:generate\n\n";
}

echo "═══════════════════════════════════════════════════════════\n";
echo "7. TESTING REGISTRATION ROUTE\n";
echo "═══════════════════════════════════════════════════════════\n";

try {
    $routes = Route::getRoutes();
    $registerRoute = null;
    
    foreach ($routes as $route) {
        if ($route->uri() === 'register' && in_array('POST', $route->methods())) {
            $registerRoute = $route;
            break;
        }
    }
    
    if ($registerRoute) {
        echo "✓ Registration route found\n";
        echo "  URI: " . $registerRoute->uri() . "\n";
        echo "  Methods: " . implode(', ', $registerRoute->methods()) . "\n";
        echo "  Action: " . $registerRoute->getActionName() . "\n\n";
    } else {
        echo "✗ WARNING: Registration route not found!\n\n";
    }
} catch (Exception $e) {
    echo "✗ Error checking routes: " . $e->getMessage() . "\n\n";
}

echo "═══════════════════════════════════════════════════════════\n";
echo "DIAGNOSTIC SUMMARY\n";
echo "═══════════════════════════════════════════════════════════\n\n";

echo "If you see this message, the basic functionality is WORKING.\n";
echo "The issue might be:\n\n";

echo "1. CSRF Token Issue\n";
echo "   - Clear browser cache and cookies\n";
echo "   - Try in incognito/private mode\n\n";

echo "2. Session Issue\n";
echo "   - Clear sessions: php artisan session:clear\n";
echo "   - Check storage/framework/sessions is writable\n\n";

echo "3. Cache Issue\n";
echo "   - Clear cache: php artisan cache:clear\n";
echo "   - Clear config: php artisan config:clear\n\n";

echo "4. Validation Errors\n";
echo "   - Check if form fields match validation rules\n";
echo "   - Check browser console for JavaScript errors\n\n";

echo "5. Database Permissions\n";
echo "   - Check if database user has INSERT permissions\n\n";

echo "═══════════════════════════════════════════════════════════\n";
echo "NEXT STEPS\n";
echo "═══════════════════════════════════════════════════════════\n\n";

echo "1. Run this script: php emergency-diagnostic.php\n";
echo "2. Try registering again and note the exact error message\n";
echo "3. Check storage/logs/laravel.log for errors\n";
echo "4. Try clearing cache: php artisan cache:clear\n";
echo "5. Report back with the error message you see\n\n";

echo "═══════════════════════════════════════════════════════════\n";
echo "DIAGNOSTIC COMPLETE\n";
echo "═══════════════════════════════════════════════════════════\n";
