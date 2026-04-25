<?php
echo "Testing database connection...\n";
try {
    $pdo = new PDO('sqlite:database/database.sqlite');
    echo "✓ Database connection successful!\n";
    
    $stmt = $pdo->query("SELECT COUNT(*) FROM users");
    $count = $stmt->fetchColumn();
    echo "✓ Users table accessible, found {$count} users\n";
} catch(Exception $e) {
    echo "✗ Database connection failed: " . $e->getMessage() . "\n";
}