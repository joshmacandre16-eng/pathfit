<?php
/**
 * Database Verification Script
 * Upload this to public/ folder on BOTH domains to verify they're using the same database
 * 
 * Access via:
 * - https://pathfit.online/verify-db.php
 * - https://pathfit-production.up.railway.app/verify-db.php
 */

// Prevent direct access in production (remove this check for testing)
// if ($_SERVER['REMOTE_ADDR'] !== 'YOUR_IP') {
//     die('Access denied');
// }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Database Verification - PathFit</title>
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
            max-width: 900px;
            margin: 0 auto;
            background: #1E2418;
            border: 2px solid rgba(16, 185, 129, 0.3);
            border-radius: 16px;
            padding: 40px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
        }
        h1 {
            color: #10b981;
            margin-bottom: 10px;
            font-size: 32px;
        }
        .subtitle {
            color: #8A9480;
            margin-bottom: 30px;
            font-size: 14px;
        }
        .info-box {
            background: rgba(16, 185, 129, 0.05);
            border: 1px solid rgba(16, 185, 129, 0.3);
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
        }
        .info-box.success {
            background: rgba(16, 185, 129, 0.1);
            border-color: #10b981;
        }
        .info-box.error {
            background: rgba(220, 53, 69, 0.1);
            border-color: #dc3545;
        }
        .info-row {
            display: grid;
            grid-template-columns: 200px 1fr;
            gap: 15px;
            padding: 12px 0;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        }
        .info-row:last-child {
            border-bottom: none;
        }
        .info-label {
            color: #8A9480;
            font-weight: 600;
        }
        .info-value {
            color: #E8EDE0;
            font-family: 'Courier New', monospace;
            word-break: break-all;
        }
        .status {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
        }
        .status.success {
            background: rgba(16, 185, 129, 0.2);
            color: #10b981;
        }
        .status.error {
            background: rgba(220, 53, 69, 0.2);
            color: #dc3545;
        }
        h2 {
            color: #10b981;
            margin: 30px 0 15px 0;
            font-size: 20px;
        }
        .user-list {
            background: rgba(0, 0, 0, 0.2);
            border-radius: 8px;
            padding: 15px;
            max-height: 300px;
            overflow-y: auto;
        }
        .user-item {
            padding: 10px;
            background: rgba(255, 255, 255, 0.02);
            border-radius: 6px;
            margin-bottom: 8px;
            font-size: 13px;
        }
        .user-item:last-child {
            margin-bottom: 0;
        }
        .highlight {
            color: #10b981;
            font-weight: 600;
        }
        .warning {
            background: rgba(255, 193, 7, 0.1);
            border: 1px solid rgba(255, 193, 7, 0.3);
            color: #ffc107;
            padding: 15px;
            border-radius: 8px;
            margin-top: 20px;
        }
        @media (max-width: 768px) {
            .info-row {
                grid-template-columns: 1fr;
                gap: 5px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>🔍 Database Verification</h1>
        <p class="subtitle">Checking database connection and configuration</p>

<?php
try {
    // Load Laravel
    require __DIR__.'/../vendor/autoload.php';
    $app = require_once __DIR__.'/../bootstrap/app.php';
    $kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
    $kernel->bootstrap();

    // Get current domain
    $currentDomain = $_SERVER['HTTP_HOST'];
    
    echo '<div class="info-box">';
    echo '<div class="info-row">';
    echo '<div class="info-label">Current Domain:</div>';
    echo '<div class="info-value"><strong>' . htmlspecialchars($currentDomain) . '</strong></div>';
    echo '</div>';
    echo '<div class="info-row">';
    echo '<div class="info-label">App Environment:</div>';
    echo '<div class="info-value">' . config('app.env') . '</div>';
    echo '</div>';
    echo '<div class="info-row">';
    echo '<div class="info-label">App URL:</div>';
    echo '<div class="info-value">' . config('app.url') . '</div>';
    echo '</div>';
    echo '</div>';

    // Test database connection
    echo '<h2>📊 Database Connection</h2>';
    
    try {
        $pdo = DB::connection()->getPdo();
        
        echo '<div class="info-box success">';
        echo '<div class="info-row">';
        echo '<div class="info-label">Connection Status:</div>';
        echo '<div class="info-value"><span class="status success">✓ Connected</span></div>';
        echo '</div>';
        echo '<div class="info-row">';
        echo '<div class="info-label">DB Connection:</div>';
        echo '<div class="info-value">' . config('database.default') . '</div>';
        echo '</div>';
        echo '<div class="info-row">';
        echo '<div class="info-label">DB Host:</div>';
        echo '<div class="info-value">' . config('database.connections.mysql.host') . '</div>';
        echo '</div>';
        echo '<div class="info-row">';
        echo '<div class="info-label">DB Port:</div>';
        echo '<div class="info-value">' . config('database.connections.mysql.port') . '</div>';
        echo '</div>';
        echo '<div class="info-row">';
        echo '<div class="info-label">DB Database:</div>';
        echo '<div class="info-value">' . config('database.connections.mysql.database') . '</div>';
        echo '</div>';
        echo '<div class="info-row">';
        echo '<div class="info-label">DB Username:</div>';
        echo '<div class="info-value">' . config('database.connections.mysql.username') . '</div>';
        echo '</div>';
        echo '</div>';

        // Expected Railway credentials
        $expectedHost = 'shuttle.proxy.rlwy.net';
        $expectedPort = '10519';
        $expectedDatabase = 'railway';
        
        $actualHost = config('database.connections.mysql.host');
        $actualPort = config('database.connections.mysql.port');
        $actualDatabase = config('database.connections.mysql.database');

        // Verify if using Railway database
        echo '<h2>✅ Railway Database Verification</h2>';
        echo '<div class="info-box">';
        
        $isCorrectHost = ($actualHost === $expectedHost);
        $isCorrectPort = ($actualPort == $expectedPort);
        $isCorrectDatabase = ($actualDatabase === $expectedDatabase);
        
        echo '<div class="info-row">';
        echo '<div class="info-label">Host Match:</div>';
        echo '<div class="info-value">';
        if ($isCorrectHost) {
            echo '<span class="status success">✓ Correct</span> ' . $expectedHost;
        } else {
            echo '<span class="status error">✗ Wrong</span> Expected: ' . $expectedHost . ', Got: ' . $actualHost;
        }
        echo '</div>';
        echo '</div>';

        echo '<div class="info-row">';
        echo '<div class="info-label">Port Match:</div>';
        echo '<div class="info-value">';
        if ($isCorrectPort) {
            echo '<span class="status success">✓ Correct</span> ' . $expectedPort;
        } else {
            echo '<span class="status error">✗ Wrong</span> Expected: ' . $expectedPort . ', Got: ' . $actualPort;
        }
        echo '</div>';
        echo '</div>';

        echo '<div class="info-row">';
        echo '<div class="info-label">Database Match:</div>';
        echo '<div class="info-value">';
        if ($isCorrectDatabase) {
            echo '<span class="status success">✓ Correct</span> ' . $expectedDatabase;
        } else {
            echo '<span class="status error">✗ Wrong</span> Expected: ' . $expectedDatabase . ', Got: ' . $actualDatabase;
        }
        echo '</div>';
        echo '</div>';

        echo '</div>';

        // Get user statistics
        echo '<h2>👥 User Statistics</h2>';
        
        $totalUsers = DB::table('users')->count();
        $athletes = DB::table('users')->where('role', 'Athlete')->count();
        $coaches = DB::table('users')->where('role', 'Coach')->count();
        $admins = DB::table('users')->where('role', 'Admin')->count();
        
        echo '<div class="info-box">';
        echo '<div class="info-row">';
        echo '<div class="info-label">Total Users:</div>';
        echo '<div class="info-value"><span class="highlight">' . $totalUsers . '</span></div>';
        echo '</div>';
        echo '<div class="info-row">';
        echo '<div class="info-label">Athletes:</div>';
        echo '<div class="info-value">' . $athletes . '</div>';
        echo '</div>';
        echo '<div class="info-row">';
        echo '<div class="info-label">Coaches:</div>';
        echo '<div class="info-value">' . $coaches . '</div>';
        echo '</div>';
        echo '<div class="info-row">';
        echo '<div class="info-label">Admins:</div>';
        echo '<div class="info-value">' . $admins . '</div>';
        echo '</div>';
        echo '</div>';

        // Get recent users
        echo '<h2>📋 Recent Users (Last 10)</h2>';
        $recentUsers = DB::table('users')
            ->select('id', 'name', 'email', 'role', 'created_at')
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        if ($recentUsers->count() > 0) {
            echo '<div class="user-list">';
            foreach ($recentUsers as $user) {
                echo '<div class="user-item">';
                echo '<strong>' . htmlspecialchars($user->name) . '</strong> ';
                echo '(' . htmlspecialchars($user->email) . ') ';
                echo '- <span class="highlight">' . $user->role . '</span> ';
                echo '- Registered: ' . date('Y-m-d H:i:s', strtotime($user->created_at));
                echo '</div>';
            }
            echo '</div>';
        } else {
            echo '<p style="color: #8A9480;">No users found in database.</p>';
        }

        // Final verdict
        if ($isCorrectHost && $isCorrectPort && $isCorrectDatabase) {
            echo '<div class="warning" style="background: rgba(16, 185, 129, 0.1); border-color: #10b981; color: #10b981;">';
            echo '<strong>✅ SUCCESS!</strong><br>';
            echo 'This domain is correctly connected to the Railway database.<br>';
            echo 'Total users in shared database: <strong>' . $totalUsers . '</strong>';
            echo '</div>';
        } else {
            echo '<div class="warning">';
            echo '<strong>⚠️ WARNING!</strong><br>';
            echo 'This domain is NOT using the correct Railway database.<br>';
            echo 'Please update the environment variables to use Railway database credentials.';
            echo '</div>';
        }

    } catch (Exception $e) {
        echo '<div class="info-box error">';
        echo '<div class="info-row">';
        echo '<div class="info-label">Connection Status:</div>';
        echo '<div class="info-value"><span class="status error">✗ Failed</span></div>';
        echo '</div>';
        echo '<div class="info-row">';
        echo '<div class="info-label">Error Message:</div>';
        echo '<div class="info-value" style="color: #dc3545;">' . htmlspecialchars($e->getMessage()) . '</div>';
        echo '</div>';
        echo '</div>';

        echo '<div class="warning">';
        echo '<strong>⚠️ DATABASE CONNECTION FAILED!</strong><br>';
        echo 'Please check your database configuration in the .env file.';
        echo '</div>';
    }

} catch (Exception $e) {
    echo '<div class="info-box error">';
    echo '<p style="color: #dc3545;"><strong>Error:</strong> ' . htmlspecialchars($e->getMessage()) . '</p>';
    echo '</div>';
}
?>

        <div class="warning" style="margin-top: 30px; background: rgba(60, 226, 238, 0.1); border-color: #3ce2ee; color: #3ce2ee;">
            <strong>📝 Note:</strong> Run this script on BOTH domains and compare the results.<br>
            Both should show the same user count if they're using the same database.
        </div>

        <div style="margin-top: 20px; padding: 15px; background: rgba(255, 255, 255, 0.02); border-radius: 8px; font-size: 12px; color: #8A9480;">
            <strong>Security Notice:</strong> Delete this file after verification for security purposes.
        </div>
    </div>
</body>
</html>
