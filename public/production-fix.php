<?php
/**
 * PRODUCTION FIX SCRIPT
 * Upload this to public/ folder on BOTH production domains
 * Access via: https://yourdomain.com/production-fix.php
 * 
 * This will:
 * 1. Clear all caches
 * 2. Test database connection
 * 3. Test registration functionality
 * 4. Show what's wrong
 */

// Security: Uncomment and set your IP to restrict access
// if ($_SERVER['REMOTE_ADDR'] !== 'YOUR_IP_HERE') {
//     die('Access denied');
// }

error_reporting(E_ALL);
ini_set('display_errors', 1);

?>
<!DOCTYPE html>
<html>
<head>
    <title>Production Fix - PathFit</title>
    <style>
        body { font-family: monospace; background: #0a0a0a; color: #0f0; padding: 20px; }
        .success { color: #0f0; }
        .error { color: #f00; }
        .warning { color: #ff0; }
        .info { color: #0ff; }
        pre { background: #1a1a1a; padding: 15px; border-radius: 5px; overflow-x: auto; }
        h1 { color: #0ff; }
        h2 { color: #0f0; border-bottom: 2px solid #0f0; padding-bottom: 5px; }
    </style>
</head>
<body>
<h1>🔧 PathFit Production Fix Script</h1>
<pre>
<?php

echo "Starting production fix...\n\n";

// Load Laravel
try {
    require __DIR__.'/../vendor/autoload.php';
    $app = require_once __DIR__.'/../bootstrap/app.php';
    $kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
    $kernel->bootstrap();
    echo "<span class='success'>✓ Laravel loaded</span>\n\n";
} catch (Exception $e) {
    echo "<span class='error'>✗ CRITICAL: Cannot load Laravel</span>\n";
    echo "<span class='error'>  Error: " . htmlspecialchars($e->getMessage()) . "</span>\n";
    exit;
}

echo "═══════════════════════════════════════════════════════════\n";
echo "STEP 1: CLEARING CACHES\n";
echo "═══════════════════════════════════════════════════════════\n\n";

try {
    Artisan::call('config:clear');
    echo "<span class='success'>✓ Config cache cleared</span>\n";
    
    Artisan::call('cache:clear');
    echo "<span class='success'>✓ Application cache cleared</span>\n";
    
    Artisan::call('route:clear');
    echo "<span class='success'>✓ Route cache cleared</span>\n";
    
    Artisan::call('view:clear');
    echo "<span class='success'>✓ View cache cleared</span>\n\n";
} catch (Exception $e) {
    echo "<span class='warning'>⚠ Cache clear warning: " . htmlspecialchars($e->getMessage()) . "</span>\n\n";
}

echo "═══════════════════════════════════════════════════════════\n";
echo "STEP 2: DATABASE CONNECTION TEST\n";
echo "═══════════════════════════════════════════════════════════\n\n";

try {
    $pdo = DB::connection()->getPdo();
    echo "<span class='success'>✓ Database connected</span>\n";
    echo "<span class='info'>  Host: " . config('database.connections.mysql.host') . "</span>\n";
    echo "<span class='info'>  Port: " . config('database.connections.mysql.port') . "</span>\n";
    echo "<span class='info'>  Database: " . config('database.connections.mysql.database') . "</span>\n";
    echo "<span class='info'>  Username: " . config('database.connections.mysql.username') . "</span>\n\n";
    
    // Check if using Railway database
    $expectedHost = 'shuttle.proxy.rlwy.net';
    $actualHost = config('database.connections.mysql.host');
    
    if ($actualHost === $expectedHost) {
        echo "<span class='success'>✓ Using Railway database (CORRECT)</span>\n\n";
    } else {
        echo "<span class='warning'>⚠ NOT using Railway database</span>\n";
        echo "<span class='warning'>  Expected: shuttle.proxy.rlwy.net</span>\n";
        echo "<span class='warning'>  Got: " . $actualHost . "</span>\n\n";
    }
    
} catch (Exception $e) {
    echo "<span class='error'>✗ CRITICAL: Database connection FAILED</span>\n";
    echo "<span class='error'>  Error: " . htmlspecialchars($e->getMessage()) . "</span>\n\n";
    echo "<span class='warning'>FIX: Update environment variables with Railway database credentials</span>\n\n";
    exit;
}

echo "═══════════════════════════════════════════════════════════\n";
echo "STEP 3: USERS TABLE CHECK\n";
echo "═══════════════════════════════════════════════════════════\n\n";

try {
    $userCount = DB::table('users')->count();
    echo "<span class='success'>✓ Users table accessible</span>\n";
    echo "<span class='info'>  Total users: " . $userCount . "</span>\n\n";
} catch (Exception $e) {
    echo "<span class='error'>✗ Cannot access users table</span>\n";
    echo "<span class='error'>  Error: " . htmlspecialchars($e->getMessage()) . "</span>\n\n";
}

echo "═══════════════════════════════════════════════════════════\n";
echo "STEP 4: INSERT PERMISSION TEST\n";
echo "═══════════════════════════════════════════════════════════\n\n";

try {
    $testEmail = 'prodfix_' . time() . '@example.com';
    
    DB::table('users')->insert([
        'name' => 'Production Fix Test',
        'fname' => 'Production',
        'lname' => 'Test',
        'course' => 'Test',
        'gender' => 'male',
        'email' => $testEmail,
        'password' => Hash::make('test123'),
        'role' => 'Athlete',
        'email_verified_at' => now(),
        'created_at' => now(),
        'updated_at' => now(),
    ]);
    
    echo "<span class='success'>✓ INSERT permission: OK</span>\n";
    
    $testUser = DB::table('users')->where('email', $testEmail)->first();
    if ($testUser) {
        echo "<span class='success'>✓ Data verification: OK</span>\n";
        echo "<span class='info'>  User ID: " . $testUser->id . "</span>\n";
        
        DB::table('users')->where('email', $testEmail)->delete();
        echo "<span class='success'>✓ Cleanup: OK</span>\n\n";
    }
    
} catch (Exception $e) {
    echo "<span class='error'>✗ CRITICAL: Cannot INSERT into database</span>\n";
    echo "<span class='error'>  Error: " . htmlspecialchars($e->getMessage()) . "</span>\n\n";
    echo "<span class='warning'>This is the problem! Database user lacks INSERT permission.</span>\n\n";
}

echo "═══════════════════════════════════════════════════════════\n";
echo "STEP 5: USER MODEL TEST\n";
echo "═══════════════════════════════════════════════════════════\n\n";

try {
    $testEmail = 'model_' . time() . '@example.com';
    
    $user = App\Models\User::create([
        'name' => 'Model Test',
        'fname' => 'Model',
        'lname' => 'Test',
        'course' => 'Test',
        'gender' => 'female',
        'email' => $testEmail,
        'password' => Hash::make('test123'),
        'role' => 'Athlete',
        'email_verified_at' => now(),
    ]);
    
    echo "<span class='success'>✓ User model creation: OK</span>\n";
    echo "<span class='info'>  User ID: " . $user->id . "</span>\n";
    
    $user->delete();
    echo "<span class='success'>✓ Cleanup: OK</span>\n\n";
    
} catch (Exception $e) {
    echo "<span class='error'>✗ User model creation FAILED</span>\n";
    echo "<span class='error'>  Error: " . htmlspecialchars($e->getMessage()) . "</span>\n\n";
}

echo "═══════════════════════════════════════════════════════════\n";
echo "STEP 6: RECENT USERS\n";
echo "═══════════════════════════════════════════════════════════\n\n";

try {
    $recentUsers = DB::table('users')
        ->select('id', 'name', 'email', 'role', 'created_at')
        ->orderBy('created_at', 'desc')
        ->limit(5)
        ->get();
    
    echo "<span class='success'>✓ Recent users (last 5):</span>\n";
    foreach ($recentUsers as $user) {
        echo "<span class='info'>  - " . htmlspecialchars($user->name) . " (" . htmlspecialchars($user->email) . ") - " . $user->role . "</span>\n";
    }
    echo "\n";
} catch (Exception $e) {
    echo "<span class='error'>✗ Cannot fetch users: " . htmlspecialchars($e->getMessage()) . "</span>\n\n";
}

echo "═══════════════════════════════════════════════════════════\n";
echo "SUMMARY\n";
echo "═══════════════════════════════════════════════════════════\n\n";

echo "<span class='success'>If all tests above passed, registration should work!</span>\n\n";

echo "<span class='info'>Current Domain: " . $_SERVER['HTTP_HOST'] . "</span>\n";
echo "<span class='info'>Environment: " . config('app.env') . "</span>\n\n";

echo "<span class='warning'>SECURITY: Delete this file after testing!</span>\n\n";

echo "═══════════════════════════════════════════════════════════\n";
echo "NEXT STEPS\n";
echo "═══════════════════════════════════════════════════════════\n\n";

echo "1. Try registering at: https://" . $_SERVER['HTTP_HOST'] . "/register\n";
echo "2. If it fails, check the exact error message\n";
echo "3. Check Laravel logs at: storage/logs/laravel.log\n";
echo "4. DELETE THIS FILE for security\n\n";

?>
</pre>
</body>
</html>
