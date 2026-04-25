<?php
// EMERGENCY FIX FOR PATHFIT.ONLINE
// Upload to: public/emergency-fix.php
// Visit: https://pathfit.online/emergency-fix.php

error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<h1>Emergency Fix for PathFit.online</h1><hr>";

$fixed = [];
$errors = [];

// Fix 1: Clear route cache
$routeCache = __DIR__ . '/../bootstrap/cache/routes-v7.php';
if (file_exists($routeCache)) {
    if (unlink($routeCache)) {
        $fixed[] = "✓ Route cache deleted";
    } else {
        $errors[] = "✗ Cannot delete route cache";
    }
} else {
    $fixed[] = "✓ Route cache already clear";
}

// Fix 2: Clear config cache
$configCache = __DIR__ . '/../bootstrap/cache/config.php';
if (file_exists($configCache)) {
    if (unlink($configCache)) {
        $fixed[] = "✓ Config cache deleted";
    } else {
        $errors[] = "✗ Cannot delete config cache";
    }
} else {
    $fixed[] = "✓ Config cache already clear";
}

// Fix 3: Clear view cache
$viewPath = __DIR__ . '/../storage/framework/views';
if (is_dir($viewPath)) {
    $files = glob($viewPath . '/*');
    $count = 0;
    foreach ($files as $file) {
        if (is_file($file) && unlink($file)) {
            $count++;
        }
    }
    $fixed[] = "✓ Deleted $count view cache files";
}

// Fix 4: Clear application cache
$cachePath = __DIR__ . '/../storage/framework/cache/data';
if (is_dir($cachePath)) {
    $files = glob($cachePath . '/*/*');
    $count = 0;
    foreach ($files as $file) {
        if (is_file($file) && unlink($file)) {
            $count++;
        }
    }
    $fixed[] = "✓ Deleted $count cache data files";
}

// Fix 5: Check .env database config
$envPath = __DIR__ . '/../.env';
if (file_exists($envPath)) {
    $envContent = file_get_contents($envPath);
    if (strpos($envContent, 'shuttle.proxy.rlwy.net') !== false) {
        $fixed[] = "✓ Database config correct (Railway)";
    } else {
        $errors[] = "✗ Database NOT configured for Railway!";
        echo "<h2>UPDATE YOUR .env FILE:</h2>";
        echo "<pre>DB_CONNECTION=mysql
DB_HOST=shuttle.proxy.rlwy.net
DB_PORT=10519
DB_DATABASE=railway
DB_USERNAME=root
DB_PASSWORD=yrxVjcGIkzEUSNackIDSDlqmNhNnzKMp</pre>";
    }
}

// Display results
echo "<h2>Fixed:</h2>";
foreach ($fixed as $fix) {
    echo "<p style='color:green'>$fix</p>";
}

if (!empty($errors)) {
    echo "<h2>Errors:</h2>";
    foreach ($errors as $error) {
        echo "<p style='color:red'>$error</p>";
    }
}

if (empty($errors)) {
    echo "<hr><h2 style='color:green'>✓ REGISTRATION FIXED!</h2>";
    echo "<p><a href='/register' style='padding:10px 20px; background:green; color:white; text-decoration:none; font-size:18px;'>Test Registration Now</a></p>";
} else {
    echo "<hr><h2 style='color:red'>Fix the errors above first</h2>";
}
