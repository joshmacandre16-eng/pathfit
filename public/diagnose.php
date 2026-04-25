<?php
/**
 * PATHFIT.ONLINE DIAGNOSTIC
 * Upload this to pathfit.online public folder
 * Visit: https://pathfit.online/diagnose.php
 */
?>
<!DOCTYPE html>
<html>
<head>
    <title>PathFit.Online Diagnostic</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: linear-gradient(135deg, #0D0F0A 0%, #1a1d14 100%);
            color: #E8EDE0;
            padding: 40px 20px;
            line-height: 1.6;
        }
        .container {
            max-width: 1000px;
            margin: 0 auto;
            background: #1E2418;
            border: 2px solid rgba(16, 185, 129, 0.3);
            border-radius: 16px;
            padding: 40px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
        }
        h1 { color: #10b981; margin-bottom: 30px; font-size: 32px; }
        h2 { color: #10b981; margin: 30px 0 15px 0; font-size: 24px; border-bottom: 2px solid #10b981; padding-bottom: 10px; }
        .status-box {
            background: rgba(0, 0, 0, 0.3);
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
        }
        .status-row {
            display: grid;
            grid-template-columns: 250px 1fr;
            gap: 20px;
            padding: 15px 0;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        }
        .status-row:last-child { border-bottom: none; }
        .label { color: #8A9480; font-weight: 600; }
        .value { color: #E8EDE0; font-family: 'Courier New', monospace; word-break: break-all; }
        .success { color: #10b981; font-weight: bold; }
        .error { color: #dc3545; font-weight: bold; }
        .warning { color: #ffc107; font-weight: bold; }
        .alert {
            padding: 20px;
            border-radius: 10px;
            margin: 20px 0;
            border-left: 4px solid;
        }
        .alert-success { background: rgba(16, 185, 129, 0.1); border-color: #10b981; color: #10b981; }
        .alert-error { background: rgba(220, 53, 69, 0.1); border-color: #dc3545; color: #dc3545; }
        .alert-warning { background: rgba(255, 193, 7, 0.1); border-color: #ffc107; color: #ffc107; }
        .code-block {
            background: #0a0a0a;
            border: 1px solid rgba(16, 185, 129, 0.3);
            border-radius: 8px;
            padding: 20px;
            margin: 15px 0;
            overflow-x: auto;
        }
        .code-block code {
            color: #10b981;
            font-family: 'Courier New', monospace;
            font-size: 14px;
        }
        .btn {
            display: inline-block;
            background: #10b981;
            color: #0D0F0A;
            padding: 12px 24px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            margin: 10px 10px 10px 0;
        }
        .btn:hover { background: #059669; }
        ol { margin-left: 20px; margin-top: 10px; }
        ol li { margin-bottom: 10px; }
    </style>
</head>
<body>
    <div class="container">
        <h1>🔍 PathFit.Online Diagnostic Report</h1>
        
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$hasError = false;
$errorMessages = [];
$fixInstructions = [];

// Load Laravel
try {
    require __DIR__.'/../vendor/autoload.php';
    $app = require_once __DIR__.'/../bootstrap/app.php';
    $kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
    $kernel->bootstrap();
} catch (Exception $e) {
    echo '<div class="alert alert-error">';
    echo '<strong>CRITICAL ERROR:</strong> Cannot load Laravel<br>';
    echo 'Error: ' . htmlspecialchars($e->getMessage());
    echo '</div>';
    exit;
}

echo '<h2>📊 Current Configuration</h2>';
echo '<div class="status-box">';

// Current domain
echo '<div class="status-row">';
echo '<div class="label">Current Domain:</div>';
echo '<div class="value"><strong>' . htmlspecialchars($_SERVER['HTTP_HOST']) . '</strong></div>';
echo '</div>';

// Environment
echo '<div class="status-row">';
echo '<div class="label">Environment:</div>';
echo '<div class="value">' . config('app.env') . '</div>';
echo '</div>';

// Database connection
$dbHost = config('database.connections.mysql.host');
$dbPort = config('database.connections.mysql.port');
$dbDatabase = config('database.connections.mysql.database');
$dbUsername = config('database.connections.mysql.username');

echo '<div class="status-row">';
echo '<div class="label">DB Host:</div>';
echo '<div class="value">' . htmlspecialchars($dbHost) . '</div>';
echo '</div>';

echo '<div class="status-row">';
echo '<div class="label">DB Port:</div>';
echo '<div class="value">' . htmlspecialchars($dbPort) . '</div>';
echo '</div>';

echo '<div class="status-row">';
echo '<div class="label">DB Database:</div>';
echo '<div class="value">' . htmlspecialchars($dbDatabase) . '</div>';
echo '</div>';

echo '<div class="status-row">';
echo '<div class="label">DB Username:</div>';
echo '<div class="value">' . htmlspecialchars($dbUsername) . '</div>';
echo '</div>';

echo '</div>';

// Check if using Railway database
$expectedHost = 'shuttle.proxy.rlwy.net';
$expectedPort = '10519';
$expectedDatabase = 'railway';

$isCorrectHost = ($dbHost === $expectedHost);
$isCorrectPort = ($dbPort == $expectedPort);
$isCorrectDatabase = ($dbDatabase === $expectedDatabase);

echo '<h2>✅ Railway Database Check</h2>';

if ($isCorrectHost && $isCorrectPort && $isCorrectDatabase) {
    echo '<div class="alert alert-success">';
    echo '<strong>✓ CORRECT CONFIGURATION!</strong><br>';
    echo 'This domain is using the Railway database.';
    echo '</div>';
} else {
    $hasError = true;
    echo '<div class="alert alert-error">';
    echo '<strong>✗ WRONG CONFIGURATION!</strong><br>';
    echo 'This domain is NOT using the Railway database.<br><br>';
    echo '<strong>Expected Railway Configuration:</strong><br>';
    echo 'Host: ' . $expectedHost . '<br>';
    echo 'Port: ' . $expectedPort . '<br>';
    echo 'Database: ' . $expectedDatabase . '<br><br>';
    echo '<strong>Current Configuration:</strong><br>';
    echo 'Host: ' . htmlspecialchars($dbHost) . ' ' . ($isCorrectHost ? '<span class="success">✓</span>' : '<span class="error">✗</span>') . '<br>';
    echo 'Port: ' . htmlspecialchars($dbPort) . ' ' . ($isCorrectPort ? '<span class="success">✓</span>' : '<span class="error">✗</span>') . '<br>';
    echo 'Database: ' . htmlspecialchars($dbDatabase) . ' ' . ($isCorrectDatabase ? '<span class="success">✓</span>' : '<span class="error">✗</span>') . '<br>';
    echo '</div>';
    
    $errorMessages[] = "pathfit.online is not configured to use Railway database";
    $fixInstructions[] = "Update environment variables with Railway database credentials";
}

// Test database connection
echo '<h2>🔌 Database Connection Test</h2>';

try {
    $pdo = DB::connection()->getPdo();
    echo '<div class="alert alert-success">';
    echo '<strong>✓ Database Connected</strong><br>';
    echo 'Successfully connected to: ' . htmlspecialchars($dbDatabase);
    echo '</div>';
    
    // Test user count
    $userCount = DB::table('users')->count();
    echo '<div class="status-box">';
    echo '<div class="status-row">';
    echo '<div class="label">Total Users:</div>';
    echo '<div class="value"><strong>' . $userCount . '</strong></div>';
    echo '</div>';
    echo '</div>';
    
} catch (Exception $e) {
    $hasError = true;
    echo '<div class="alert alert-error">';
    echo '<strong>✗ Database Connection Failed</strong><br>';
    echo 'Error: ' . htmlspecialchars($e->getMessage());
    echo '</div>';
    
    $errorMessages[] = "Cannot connect to database";
    $fixInstructions[] = "Verify database credentials are correct";
}

// Test INSERT permission
echo '<h2>💾 Database Write Test</h2>';

try {
    $testEmail = 'diagnose_' . time() . '@test.com';
    
    DB::table('users')->insert([
        'name' => 'Diagnostic Test',
        'fname' => 'Diagnostic',
        'lname' => 'Test',
        'course' => 'Test',
        'gender' => 'male',
        'email' => $testEmail,
        'password' => Hash::make('test'),
        'role' => 'Athlete',
        'email_verified_at' => now(),
        'created_at' => now(),
        'updated_at' => now(),
    ]);
    
    echo '<div class="alert alert-success">';
    echo '<strong>✓ Database Write Permission: OK</strong><br>';
    echo 'Successfully inserted test record.';
    echo '</div>';
    
    // Cleanup
    DB::table('users')->where('email', $testEmail)->delete();
    
} catch (Exception $e) {
    $hasError = true;
    echo '<div class="alert alert-error">';
    echo '<strong>✗ Database Write Failed</strong><br>';
    echo 'Error: ' . htmlspecialchars($e->getMessage());
    echo '</div>';
    
    $errorMessages[] = "Cannot write to database";
    $fixInstructions[] = "Check database user has INSERT permissions";
}

// Summary
echo '<h2>📋 Diagnostic Summary</h2>';

if ($hasError) {
    echo '<div class="alert alert-error">';
    echo '<strong>❌ ISSUES FOUND</strong><br><br>';
    echo '<strong>Problems:</strong><br>';
    foreach ($errorMessages as $msg) {
        echo '• ' . $msg . '<br>';
    }
    echo '</div>';
    
    echo '<h2>🔧 How to Fix</h2>';
    echo '<div class="alert alert-warning">';
    echo '<strong>Follow these steps:</strong><br><br>';
    
    echo '<ol>';
    echo '<li><strong>Update Environment Variables</strong><br>';
    echo 'Set these in your hosting control panel or .env file:';
    echo '<div class="code-block"><code>';
    echo 'DB_CONNECTION=mysql<br>';
    echo 'DB_HOST=shuttle.proxy.rlwy.net<br>';
    echo 'DB_PORT=10519<br>';
    echo 'DB_DATABASE=railway<br>';
    echo 'DB_USERNAME=root<br>';
    echo 'DB_PASSWORD=yrxVjcGIkzEUSNackIDSDlqmNhNnzKMp<br>';
    echo 'SESSION_DRIVER=database<br>';
    echo 'CACHE_STORE=database';
    echo '</code></div>';
    echo '</li>';
    
    echo '<li><strong>Clear Cache</strong><br>';
    echo 'Run these commands or use clear-cache.php:';
    echo '<div class="code-block"><code>';
    echo 'php artisan config:clear<br>';
    echo 'php artisan cache:clear<br>';
    echo 'php artisan route:clear<br>';
    echo 'php artisan view:clear';
    echo '</code></div>';
    echo '</li>';
    
    echo '<li><strong>Test Again</strong><br>';
    echo 'Refresh this page and verify all checks pass.';
    echo '</li>';
    
    echo '<li><strong>Test Registration</strong><br>';
    echo 'Try registering at: <a href="/register" class="btn">Test Registration</a>';
    echo '</li>';
    echo '</ol>';
    
    echo '</div>';
    
} else {
    echo '<div class="alert alert-success">';
    echo '<strong>✅ ALL CHECKS PASSED!</strong><br><br>';
    echo 'pathfit.online is correctly configured.<br>';
    echo 'Registration should be working now!';
    echo '</div>';
    
    echo '<a href="/register" class="btn">Test Registration Now</a>';
}

echo '<div class="alert alert-warning" style="margin-top: 30px;">';
echo '<strong>⚠️ SECURITY WARNING</strong><br>';
echo 'Delete this file (diagnose.php) after fixing the issue!';
echo '</div>';

?>
    </div>
</body>
</html>
