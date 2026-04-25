<?php
/**
 * Registration Debug Test Script
 * This script helps diagnose registration issues
 */

echo "=== PathFit Registration Debug Test ===\n\n";

// Test 1: Check if we can load Laravel
echo "1. Testing Laravel Bootstrap...\n";
try {
    require __DIR__.'/vendor/autoload.php';
    $app = require_once __DIR__.'/bootstrap/app.php';
    $kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
    $kernel->bootstrap();
    echo "   ✓ Laravel loaded successfully\n\n";
} catch (Exception $e) {
    echo "   ✗ Failed to load Laravel: " . $e->getMessage() . "\n\n";
    exit(1);
}

// Test 2: Check database connection
echo "2. Testing Database Connection...\n";
try {
    $pdo = DB::connection()->getPdo();
    echo "   ✓ Database connected: " . DB::connection()->getDatabaseName() . "\n";
    echo "   ✓ Driver: " . DB::connection()->getDriverName() . "\n\n";
} catch (Exception $e) {
    echo "   ✗ Database connection failed: " . $e->getMessage() . "\n\n";
}

// Test 3: Check if users table exists
echo "3. Checking Users Table...\n";
try {
    $tableExists = Schema::hasTable('users');
    if ($tableExists) {
        echo "   ✓ Users table exists\n";
        
        // Check columns
        $columns = ['name', 'email', 'password', 'fname', 'mname', 'lname', 'course', 'gender', 'role'];
        foreach ($columns as $column) {
            if (Schema::hasColumn('users', $column)) {
                echo "   ✓ Column '$column' exists\n";
            } else {
                echo "   ✗ Column '$column' is MISSING\n";
            }
        }
    } else {
        echo "   ✗ Users table does NOT exist\n";
    }
    echo "\n";
} catch (Exception $e) {
    echo "   ✗ Error checking table: " . $e->getMessage() . "\n\n";
}

// Test 4: Check environment configuration
echo "4. Checking Environment Configuration...\n";
echo "   APP_ENV: " . config('app.env') . "\n";
echo "   APP_DEBUG: " . (config('app.debug') ? 'true' : 'false') . "\n";
echo "   APP_URL: " . config('app.url') . "\n";
echo "   DB_CONNECTION: " . config('database.default') . "\n";
echo "   DB_HOST: " . config('database.connections.mysql.host') . "\n";
echo "   DB_DATABASE: " . config('database.connections.mysql.database') . "\n";
echo "   SESSION_DRIVER: " . config('session.driver') . "\n\n";

// Test 5: Try to create a test user
echo "5. Testing User Creation...\n";
try {
    $testEmail = 'test_' . time() . '@example.com';
    
    $user = App\Models\User::create([
        'name' => 'Test User',
        'fname' => 'Test',
        'mname' => 'Middle',
        'lname' => 'User',
        'course' => 'Test Course',
        'gender' => 'male',
        'email' => $testEmail,
        'password' => Hash::make('password123'),
        'role' => 'Athlete',
        'email_verified_at' => now(),
    ]);
    
    echo "   ✓ Test user created successfully (ID: {$user->id})\n";
    
    // Clean up - delete test user
    $user->delete();
    echo "   ✓ Test user deleted (cleanup)\n\n";
    
} catch (Exception $e) {
    echo "   ✗ Failed to create user: " . $e->getMessage() . "\n";
    echo "   Stack trace:\n";
    echo "   " . str_replace("\n", "\n   ", $e->getTraceAsString()) . "\n\n";
}

// Test 6: Check routes
echo "6. Checking Registration Routes...\n";
try {
    $routes = Route::getRoutes();
    $registerRoutes = [];
    
    foreach ($routes as $route) {
        if (str_contains($route->uri(), 'register')) {
            $registerRoutes[] = [
                'method' => implode('|', $route->methods()),
                'uri' => $route->uri(),
                'name' => $route->getName(),
                'action' => $route->getActionName(),
            ];
        }
    }
    
    if (count($registerRoutes) > 0) {
        echo "   ✓ Found " . count($registerRoutes) . " registration route(s):\n";
        foreach ($registerRoutes as $route) {
            echo "     - {$route['method']} /{$route['uri']} -> {$route['action']}\n";
        }
    } else {
        echo "   ✗ No registration routes found\n";
    }
    echo "\n";
} catch (Exception $e) {
    echo "   ✗ Error checking routes: " . $e->getMessage() . "\n\n";
}

// Test 7: Check file permissions (for production)
echo "7. Checking File Permissions...\n";
$directories = [
    'storage/logs',
    'storage/framework/sessions',
    'storage/framework/cache',
    'bootstrap/cache',
];

foreach ($directories as $dir) {
    $path = __DIR__ . '/' . $dir;
    if (is_dir($path)) {
        if (is_writable($path)) {
            echo "   ✓ $dir is writable\n";
        } else {
            echo "   ✗ $dir is NOT writable\n";
        }
    } else {
        echo "   ✗ $dir does NOT exist\n";
    }
}
echo "\n";

echo "=== Debug Test Complete ===\n";
echo "\nIf you see any ✗ marks above, those are the issues preventing registration.\n";
echo "Please fix those issues and try registering again.\n";
