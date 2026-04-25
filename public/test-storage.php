<?php
/**
 * Storage Link Test - Verify images are accessible
 * Access: https://yourdomain.com/test-storage.php
 * Delete after testing
 */

$publicStorage = __DIR__ . '/storage';
$actualStorage = dirname(__DIR__) . '/storage/app/public';

echo "<!DOCTYPE html><html><head><title>Storage Test</title>";
echo "<style>body{font-family:Arial;padding:20px;background:#f5f5f5;}";
echo ".box{background:#fff;padding:20px;margin:10px 0;border-radius:8px;box-shadow:0 2px 4px rgba(0,0,0,0.1);}";
echo ".pass{color:#10b981;} .fail{color:#ff6b6b;} img{max-width:300px;border:2px solid #ddd;margin:10px;}</style>";
echo "</head><body>";

echo "<h1>🔗 Storage Link Test</h1>";

// Check 1: Symlink exists
echo "<div class='box'>";
echo "<h3>1. Symlink Status</h3>";
if (is_link($publicStorage)) {
    echo "<span class='pass'>✅ Symlink exists</span><br>";
    echo "Points to: " . readlink($publicStorage);
} else {
    echo "<span class='fail'>❌ Symlink not found</span><br>";
    echo "Run storage-link.php first!";
}
echo "</div>";

// Check 2: Storage directory accessible
echo "<div class='box'>";
echo "<h3>2. Storage Directory</h3>";
if (is_dir($actualStorage)) {
    echo "<span class='pass'>✅ Directory exists</span><br>";
    echo "Path: {$actualStorage}";
} else {
    echo "<span class='fail'>❌ Directory not found</span>";
}
echo "</div>";

// Check 3: List files
echo "<div class='box'>";
echo "<h3>3. Files in Storage</h3>";
if (is_dir($actualStorage)) {
    $files = array_diff(scandir($actualStorage), ['.', '..']);
    if (empty($files)) {
        echo "⚠️ No files found. Upload test images to storage/app/public/";
    } else {
        echo "<ul>";
        foreach ($files as $file) {
            $fullPath = $actualStorage . '/' . $file;
            if (is_file($fullPath)) {
                echo "<li>{$file} (" . filesize($fullPath) . " bytes)</li>";
            } elseif (is_dir($fullPath)) {
                echo "<li>📁 {$file}/</li>";
            }
        }
        echo "</ul>";
    }
}
echo "</div>";

// Check 4: Display images
echo "<div class='box'>";
echo "<h3>4. Image Display Test</h3>";
$imageFound = false;
if (is_dir($actualStorage)) {
    $iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($actualStorage));
    foreach ($iterator as $file) {
        if ($file->isFile() && preg_match('/\.(jpg|jpeg|png|gif|webp)$/i', $file->getFilename())) {
            $relativePath = str_replace($actualStorage . DIRECTORY_SEPARATOR, '', $file->getPathname());
            $relativePath = str_replace('\\', '/', $relativePath);
            $url = '/storage/' . $relativePath;
            echo "<div style='display:inline-block;margin:10px;text-align:center;'>";
            echo "<img src='{$url}' alt='{$file->getFilename()}'><br>";
            echo "<small>{$file->getFilename()}</small>";
            echo "</div>";
            $imageFound = true;
        }
    }
}
if (!$imageFound) {
    echo "⚠️ No images found. Upload test images to storage/app/public/";
}
echo "</div>";

echo "<div class='box' style='background:#fff3cd;'>";
echo "<strong>⚠️ Delete this file after testing!</strong>";
echo "</div>";

echo "</body></html>";
