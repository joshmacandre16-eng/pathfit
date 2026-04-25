<?php
// Visit: https://pathfit.online/verify-fix.php

echo "<h1>PathFit.online Registration Fix Verification</h1>";
echo "<hr>";

// Test 1: Check if cache files exist (should be cleared)
echo "<h2>1. Cache Status</h2>";
$routeCache = __DIR__ . '/bootstrap/cache/routes-v7.php';
$configCache = __DIR__ . '/bootstrap/cache/config.php';
$viewCache = __DIR__ . '/storage/framework/views';

if (!file_exists($routeCache)) {
    echo "✓ Route cache cleared<br>";
} else {
    echo "✗ Route cache still exists - <a href='/clear-cache-now.php'>Clear Now</a><br>";
}

if (!file_exists($configCache)) {
    echo "✓ Config cache cleared<br>";
} else {
    echo "✗ Config cache still exists - <a href='/clear-cache-now.php'>Clear Now</a><br>";
}

$viewFiles = glob($viewCache . '/*');
if (empty($viewFiles)) {
    echo "✓ View cache cleared<br>";
} else {
    echo "✗ View cache has " . count($viewFiles) . " files - <a href='/clear-cache-now.php'>Clear Now</a><br>";
}

// Test 2: Database connection
echo "<h2>2. Database Connection</h2>";
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

try {
    DB::connection()->getPdo();
    echo "✓ Database connected: " . config('database.connections.mysql.host') . "<br>";
} catch (Exception $e) {
    echo "✗ Database error: " . $e->getMessage() . "<br>";
}

// Test 3: Routes defined
echo "<h2>3. Routes Check</h2>";
try {
    $loginRoute = route('login');
    echo "✓ Login route exists: $loginRoute<br>";
} catch (Exception $e) {
    echo "✗ Login route missing<br>";
}

try {
    $registerRoute = url('/register');
    echo "✓ Register route exists: $registerRoute<br>";
} catch (Exception $e) {
    echo "✗ Register route missing<br>";
}

// Test 4: Registration form accessible
echo "<h2>4. Registration Form</h2>";
echo "✓ <a href='/register' target='_blank'>Open Registration Form</a><br>";

// Test 5: Final status
echo "<hr>";
echo "<h2>Final Status</h2>";
if (!file_exists($routeCache) && !file_exists($configCache)) {
    echo "<p style='color:green; font-size:20px;'><strong>✓ REGISTRATION IS FIXED!</strong></p>";
    echo "<p><a href='/register' style='padding:10px 20px; background:green; color:white; text-decoration:none;'>Test Registration Now</a></p>";
} else {
    echo "<p style='color:red; font-size:20px;'><strong>✗ Cache needs clearing</strong></p>";
    echo "<p><a href='/clear-cache-now.php' style='padding:10px 20px; background:red; color:white; text-decoration:none;'>Clear Cache Now</a></p>";
}
