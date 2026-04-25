<?php
/**
 * Quick Production Test
 * Upload this to public/ folder on BOTH domains
 * Access via: https://yourdomain.com/quick-test.php
 */

error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<h1>Quick Production Test</h1>";
echo "<pre>";

// Test 1: Can we load Laravel?
echo "1. Loading Laravel...\n";
try {
    require __DIR__.'/../vendor/autoload.php';
    $app = require_once __DIR__.'/../bootstrap/app.php';
    $kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
    $kernel->bootstrap();
    echo "   ✓ SUCCESS\n\n";
} catch (Exception $e) {
    echo "   ✗ FAILED: " . $e->getMessage() . "\n\n";
    exit;
}

// Test 2: Database connection
echo "2. Testing Database Connection...\n";
try {
    $pdo = DB::connection()->getPdo();
    echo "   ✓ Connected\n";
    echo "   Host: " . config('database.connections.mysql.host') . "\n";
    echo "   Database: " . config('database.connections.mysql.database') . "\n\n";
} catch (Exception $e) {
    echo "   ✗ FAILED: " . $e->getMessage() . "\n\n";
    exit;
}

// Test 3: Can we read from users table?
echo "3. Reading from users table...\n";
try {
    $count = DB::table('users')->count();
    echo "   ✓ SUCCESS\n";
    echo "   Total users: " . $count . "\n\n";
} catch (Exception $e) {
    echo "   ✗ FAILED: " . $e->getMessage() . "\n\n";
}

// Test 4: Can we INSERT into users table?
echo "4. Testing INSERT permission...\n";
try {
    $testEmail = 'quicktest_' . time() . '@example.com';
    
    DB::table('users')->insert([
        'name' => 'Quick Test',
        'fname' => 'Quick',
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
    
    echo "   ✓ INSERT SUCCESS\n";
    
    // Verify
    $user = DB::table('users')->where('email', $testEmail)->first();
    if ($user) {
        echo "   ✓ User verified in database\n";
        echo "   User ID: " . $user->id . "\n";
        
        // Cleanup
        DB::table('users')->where('email', $testEmail)->delete();
        echo "   ✓ Cleanup complete\n\n";
    }
    
} catch (Exception $e) {
    echo "   ✗ INSERT FAILED: " . $e->getMessage() . "\n\n";
    echo "   This is the problem! Database user doesn't have INSERT permission.\n\n";
}

// Test 5: Check storage permissions
echo "5. Checking storage permissions...\n";
$dirs = [
    '../storage/logs',
    '../storage/framework/sessions',
    '../storage/framework/cache',
];

foreach ($dirs as $dir) {
    if (is_writable(__DIR__ . '/' . $dir)) {
        echo "   ✓ " . $dir . " is writable\n";
    } else {
        echo "   ✗ " . $dir . " is NOT writable\n";
    }
}

echo "\n";
echo "═══════════════════════════════════════════════════\n";
echo "RESULT:\n";
echo "═══════════════════════════════════════════════════\n";
echo "If all tests passed, registration SHOULD work.\n";
echo "If INSERT test failed, that's your problem!\n";
echo "\n";
echo "Delete this file after testing for security.\n";
echo "</pre>";
?>
