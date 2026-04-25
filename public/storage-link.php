<?php
/**
 * Manual Storage Link Creator
 * Alternative to: php artisan storage:link
 * 
 * Usage: Access this file once via browser: https://yourdomain.com/storage-link.php
 * Then delete this file for security.
 */

$storagePath = dirname(__DIR__) . '/storage/app/public';
$publicLink = __DIR__ . '/storage';

if (file_exists($publicLink)) {
    if (is_link($publicLink)) {
        echo "✅ Symbolic link already exists!<br>";
        echo "Link: {$publicLink}<br>";
        echo "Target: " . readlink($publicLink);
    } else {
        echo "❌ 'storage' exists but is not a symbolic link.<br>";
        echo "Please manually remove: {$publicLink}";
    }
    exit;
}

if (!file_exists($storagePath)) {
    mkdir($storagePath, 0755, true);
    echo "📁 Created storage directory: {$storagePath}<br>";
}

if (symlink($storagePath, $publicLink)) {
    echo "✅ Storage link created successfully!<br>";
    echo "Link: {$publicLink}<br>";
    echo "Target: {$storagePath}<br><br>";
    echo "⚠️ <strong>IMPORTANT:</strong> Delete this file (storage-link.php) now for security!";
} else {
    echo "❌ Failed to create symbolic link.<br>";
    echo "Please create it manually via FTP/cPanel:<br>";
    echo "Create symlink from: {$publicLink}<br>";
    echo "To: {$storagePath}";
}
