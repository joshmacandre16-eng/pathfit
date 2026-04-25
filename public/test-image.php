<?php
/**
 * Storage Image Display Test
 * Access: https://yourdomain.com/test-image.php
 * Delete after testing
 */

$publicStorage = __DIR__ . '/storage';
$actualStorage = dirname(__DIR__) . '/storage/app/public';

?>
<!DOCTYPE html>
<html>
<head>
    <title>Storage Image Test</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, sans-serif; background: #f5f5f5; padding: 20px; }
        .container { max-width: 1200px; margin: 0 auto; }
        h1 { color: #333; margin-bottom: 20px; }
        .status { background: #fff; padding: 15px; border-radius: 8px; margin-bottom: 20px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        .pass { color: #10b981; font-weight: bold; }
        .fail { color: #ff6b6b; font-weight: bold; }
        .warn { color: #f59e0b; font-weight: bold; }
        .gallery { display: grid; grid-template-columns: repeat(auto-fill, minmax(250px, 1fr)); gap: 20px; margin-top: 20px; }
        .image-card { background: #fff; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 8px rgba(0,0,0,0.1); }
        .image-card img { width: 100%; height: 200px; object-fit: cover; display: block; }
        .image-info { padding: 10px; font-size: 12px; color: #666; border-top: 1px solid #eee; }
        .no-images { background: #fff; padding: 40px; text-align: center; border-radius: 8px; color: #666; }
        .upload-hint { background: #fff3cd; padding: 15px; border-radius: 8px; margin-top: 20px; border-left: 4px solid #f59e0b; }
    </style>
</head>
<body>
<div class="container">
    <h1>🖼️ Storage Image Display Test</h1>
    
    <div class="status">
        <h3>Storage Link Status:</h3>
        <?php if (is_link($publicStorage)): ?>
            <?php 
                $target = readlink($publicStorage);
                $isCorrect = (realpath($target) === realpath($actualStorage));
            ?>
            <span class="pass">✅ Symlink EXISTS</span><br>
            <small>Points to: <?= $target ?></small><br>
            <?php if ($isCorrect): ?>
                <span class="pass">✅ php artisan storage:link was EXECUTED successfully</span>
            <?php else: ?>
                <span class="warn">⚠️ Symlink exists but points to wrong location</span>
            <?php endif; ?>
        <?php elseif (is_dir($publicStorage)): ?>
            <span class="fail">❌ 'storage' is a DIRECTORY, not a symlink</span><br>
            <span class="fail">❌ php artisan storage:link was NOT executed</span><br>
            <small>Delete the 'storage' folder and run storage-link.php</small>
        <?php else: ?>
            <span class="fail">❌ Symlink NOT FOUND</span><br>
            <span class="fail">❌ php artisan storage:link was NOT executed</span><br>
            <small>Run storage-link.php or execute: php artisan storage:link</small>
        <?php endif; ?>
    </div>

    <?php
    $images = [];
    
    if (is_dir($actualStorage)) {
        $iterator = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($actualStorage, RecursiveDirectoryIterator::SKIP_DOTS)
        );
        
        foreach ($iterator as $file) {
            if ($file->isFile() && preg_match('/\.(jpg|jpeg|png|gif|webp|svg)$/i', $file->getFilename())) {
                $relativePath = str_replace($actualStorage . DIRECTORY_SEPARATOR, '', $file->getPathname());
                $relativePath = str_replace('\\', '/', $relativePath);
                
                $images[] = [
                    'url' => '/storage/' . $relativePath,
                    'name' => $file->getFilename(),
                    'size' => round($file->getSize() / 1024, 2) . ' KB',
                    'path' => $relativePath
                ];
            }
        }
    }
    ?>

    <?php if (empty($images)): ?>
        <div class="no-images">
            <h2>📭 No Images Found</h2>
            <p>Upload images to: <code>storage/app/public/</code></p>
        </div>
        
        <div class="upload-hint">
            <strong>💡 How to add test images:</strong><br>
            1. Create folder: <code>storage/app/public/</code><br>
            2. Upload any .jpg, .png, or .gif files<br>
            3. Refresh this page
        </div>
    <?php else: ?>
        <div class="status">
            <span class="pass">✅ Found <?= count($images) ?> image(s)</span>
        </div>
        
        <div class="gallery">
            <?php foreach ($images as $img): ?>
                <div class="image-card">
                    <img src="<?= htmlspecialchars($img['url']) ?>" onerror="this.parentElement.innerHTML='<div style=\'padding:20px;text-align:center;color:#ff6b6b;\'>❌ Failed to load</div>'">
                    <div class="image-info">
                        <strong><?= htmlspecialchars($img['name']) ?></strong><br>
                        Size: <?= $img['size'] ?><br>
                        Path: <?= htmlspecialchars($img['path']) ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <div class="upload-hint" style="margin-top: 30px; background: #fee; border-left-color: #ff6b6b;">
        <strong>⚠️ Security Warning:</strong> Delete this file (test-image.php) after testing!
    </div>
</div>
</body>
</html>
