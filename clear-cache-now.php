<?php
// Upload this to pathfit.online root and visit: https://pathfit.online/clear-cache-now.php

$results = [];

// Clear view cache
$viewPath = __DIR__ . '/storage/framework/views';
if (is_dir($viewPath)) {
    $files = glob($viewPath . '/*');
    foreach ($files as $file) {
        if (is_file($file)) unlink($file);
    }
    $results[] = "✓ View cache cleared";
}

// Clear route cache
$routeCache = __DIR__ . '/bootstrap/cache/routes-v7.php';
if (file_exists($routeCache)) {
    unlink($routeCache);
    $results[] = "✓ Route cache cleared";
}

// Clear config cache
$configCache = __DIR__ . '/bootstrap/cache/config.php';
if (file_exists($configCache)) {
    unlink($configCache);
    $results[] = "✓ Config cache cleared";
}

// Clear application cache
$cacheFiles = glob(__DIR__ . '/storage/framework/cache/data/*/*');
foreach ($cacheFiles as $file) {
    if (is_file($file)) unlink($file);
}
$results[] = "✓ Application cache cleared";

echo "<h1>Cache Cleared on pathfit.online</h1>";
foreach ($results as $result) {
    echo "<p>$result</p>";
}
echo "<p><strong>Registration should now work!</strong></p>";
echo "<p><a href='/register'>Test Registration</a></p>";
