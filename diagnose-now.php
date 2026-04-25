<?php
// Visit: https://pathfit.online/diagnose-now.php
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<h1>PathFit.online Complete Diagnostic</h1><hr>";

// 1. Check .env file
echo "<h2>1. Environment Configuration</h2>";
$envPath = __DIR__ . '/.env';
if (file_exists($envPath)) {
    $envContent = file_get_contents($envPath);
    preg_match('/DB_HOST=(.*)/', $envContent, $host);
    preg_match('/DB_PORT=(.*)/', $envContent, $port);
    preg_match('/DB_DATABASE=(.*)/', $envContent, $database);
    preg_match('/DB_USERNAME=(.*)/', $envContent, $username);
    
    echo "DB_HOST: " . ($host[1] ?? 'NOT SET') . "<br>";
    echo "DB_PORT: " . ($port[1] ?? 'NOT SET') . "<br>";
    echo "DB_DATABASE: " . ($database[1] ?? 'NOT SET') . "<br>";
    echo "DB_USERNAME: " . ($username[1] ?? 'NOT SET') . "<br>";
    
    if (isset($host[1]) && $host[1] === 'shuttle.proxy.rlwy.net') {
        echo "<span style='color:green'>✓ Using Railway database</span><br>";
    } else {
        echo "<span style='color:red'>✗ NOT using Railway database - WRONG CONFIG!</span><br>";
    }
} else {
    echo "<span style='color:red'>✗ .env file not found!</span><br>";
}

// 2. Test database connection
echo "<h2>2. Database Connection Test</h2>";
try {
    require __DIR__ . '/vendor/autoload.php';
    $app = require_once __DIR__ . '/bootstrap/app.php';
    $kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
    $kernel->bootstrap();
    
    DB::connection()->getPdo();
    echo "<span style='color:green'>✓ Database connected</span><br>";
    
    // Check users table
    $userCount = DB::table('users')->count();
    echo "Users in database: $userCount<br>";
} catch (Exception $e) {
    echo "<span style='color:red'>✗ Database error: " . $e->getMessage() . "</span><br>";
}

// 3. Check cache files
echo "<h2>3. Cache Files Status</h2>";
$cacheIssues = [];

$routeCache = __DIR__ . '/bootstrap/cache/routes-v7.php';
if (file_exists($routeCache)) {
    echo "<span style='color:red'>✗ Route cache exists (PROBLEM!)</span><br>";
    $cacheIssues[] = 'route';
} else {
    echo "<span style='color:green'>✓ Route cache cleared</span><br>";
}

$configCache = __DIR__ . '/bootstrap/cache/config.php';
if (file_exists($configCache)) {
    echo "<span style='color:red'>✗ Config cache exists (PROBLEM!)</span><br>";
    $cacheIssues[] = 'config';
} else {
    echo "<span style='color:green'>✓ Config cache cleared</span><br>";
}

$viewFiles = glob(__DIR__ . '/storage/framework/views/*');
if (count($viewFiles) > 0) {
    echo "<span style='color:orange'>⚠ View cache has " . count($viewFiles) . " files</span><br>";
    $cacheIssues[] = 'view';
} else {
    echo "<span style='color:green'>✓ View cache cleared</span><br>";
}

// 4. Check routes
echo "<h2>4. Route Check</h2>";
try {
    $loginUrl = route('login');
    echo "<span style='color:green'>✓ Login route: $loginUrl</span><br>";
} catch (Exception $e) {
    echo "<span style='color:red'>✗ Login route error: " . $e->getMessage() . "</span><br>";
}

try {
    $registerUrl = route('register');
    echo "<span style='color:green'>✓ Register route: $registerUrl</span><br>";
} catch (Exception $e) {
    echo "<span style='color:red'>✗ Register route error: " . $e->getMessage() . "</span><br>";
}

// 5. Test registration form
echo "<h2>5. Registration Form Test</h2>";
try {
    $response = file_get_contents('https://pathfit.online/register');
    if (strpos($response, 'csrf') !== false) {
        echo "<span style='color:green'>✓ Registration form loads</span><br>";
    } else {
        echo "<span style='color:red'>✗ Registration form has issues</span><br>";
    }
} catch (Exception $e) {
    echo "<span style='color:red'>✗ Cannot load registration form: " . $e->getMessage() . "</span><br>";
}

// 6. Check permissions
echo "<h2>6. File Permissions</h2>";
$storageWritable = is_writable(__DIR__ . '/storage');
$bootstrapWritable = is_writable(__DIR__ . '/bootstrap/cache');

echo "Storage writable: " . ($storageWritable ? "<span style='color:green'>✓ Yes</span>" : "<span style='color:red'>✗ No</span>") . "<br>";
echo "Bootstrap cache writable: " . ($bootstrapWritable ? "<span style='color:green'>✓ Yes</span>" : "<span style='color:red'>✗ No</span>") . "<br>";

// FINAL VERDICT
echo "<hr><h2>FINAL DIAGNOSIS</h2>";

if (!empty($cacheIssues)) {
    echo "<div style='background:red; color:white; padding:20px; font-size:18px;'>";
    echo "<strong>PROBLEM FOUND: Cache files exist!</strong><br>";
    echo "Issues: " . implode(', ', $cacheIssues) . " cache<br>";
    echo "<a href='/clear-cache-now.php' style='color:yellow; font-size:20px;'>→ CLICK HERE TO FIX NOW</a>";
    echo "</div>";
} elseif (isset($host[1]) && $host[1] !== 'shuttle.proxy.rlwy.net') {
    echo "<div style='background:red; color:white; padding:20px; font-size:18px;'>";
    echo "<strong>PROBLEM FOUND: Wrong database configuration!</strong><br>";
    echo "You need to update .env file with Railway database credentials<br>";
    echo "</div>";
} else {
    echo "<div style='background:green; color:white; padding:20px; font-size:18px;'>";
    echo "<strong>✓ EVERYTHING LOOKS GOOD!</strong><br>";
    echo "<a href='/register' style='color:white; font-size:20px;'>→ Test Registration</a>";
    echo "</div>";
}
