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
        <h3>📋 Storage Link Verification:</h3>
        <?php 
        $linkExists = is_link($publicStorage);
        $storageExists = file_exists($publicStorage);
        $targetExists = is_dir($actualStorage);
        $isExecuted = false;
        $statusMessage = '';
        
        if ($linkExists) {
            $target = readlink($publicStorage);
            $targetReal = realpath($target);
            $actualReal = realpath($actualStorage);
            $isCorrect = ($targetReal === $actualReal);
            
            if ($isCorrect) {
                $isExecuted = true;
                $statusMessage = '<span class="pass">✅ VERIFIED: php artisan storage:link WAS EXECUTED</span>';
            } else {
                $statusMessage = '<span class="warn">⚠️ Symlink exists but points to WRONG location</span>';
            }
        } elseif ($storageExists && is_dir($publicStorage)) {
            $statusMessage = '<span class="fail">❌ FAILED: \'storage\' is a regular DIRECTORY (not a symlink)</span>';
        } else {
            $statusMessage = '<span class="fail">❌ FAILED: Symlink does NOT exist</span>';
        }
        
        echo $statusMessage;
        ?>
    </div>
    
    <div class="status">
        <h3>🔍 Detailed Check:</h3>
        <table style="width:100%; border-collapse: collapse;">
            <tr style="border-bottom: 1px solid #eee;">
                <td style="padding: 8px; font-weight: bold;">Check</td>
                <td style="padding: 8px; font-weight: bold;">Status</td>
                <td style="padding: 8px; font-weight: bold;">Details</td>
            </tr>
            <tr style="border-bottom: 1px solid #eee;">
                <td style="padding: 8px;">Symlink Exists</td>
                <td style="padding: 8px;"><?= $linkExists ? '<span class="pass">✅ YES</span>' : '<span class="fail">❌ NO</span>' ?></td>
                <td style="padding: 8px;"><?= $linkExists ? 'Found at: ' . $publicStorage : 'Not found' ?></td>
            </tr>
            <tr style="border-bottom: 1px solid #eee;">
                <td style="padding: 8px;">Target Directory</td>
                <td style="padding: 8px;"><?= $targetExists ? '<span class="pass">✅ EXISTS</span>' : '<span class="fail">❌ MISSING</span>' ?></td>
                <td style="padding: 8px;"><?= $actualStorage ?></td>
            </tr>
            <?php if ($linkExists): ?>
            <tr style="border-bottom: 1px solid #eee;">
                <td style="padding: 8px;">Link Target</td>
                <td style="padding: 8px;"><?= $isCorrect ? '<span class="pass">✅ CORRECT</span>' : '<span class="warn">⚠️ WRONG</span>' ?></td>
                <td style="padding: 8px;"><?= readlink($publicStorage) ?></td>
            </tr>
            <?php endif; ?>
            <tr style="border-bottom: 1px solid #eee;">
                <td style="padding: 8px; font-weight: bold;">Command Executed</td>
                <td style="padding: 8px; font-weight: bold;"><?= $isExecuted ? '<span class="pass">✅ YES</span>' : '<span class="fail">❌ NO</span>' ?></td>
                <td style="padding: 8px;"><?= $isExecuted ? 'Storage link is working' : 'Run storage-link.php' ?></td>
            </tr>
        </table>
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
