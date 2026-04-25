<?php

echo "Setting up PathFit database...\n";

try {
    // Connect to MySQL server (without database)
    $pdo = new PDO('mysql:host=127.0.0.1;port=3306', 'root', '', [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    ]);
    
    echo "✓ Connected to MySQL server\n";
    
    // Create database if it doesn't exist
    $pdo->exec("CREATE DATABASE IF NOT EXISTS pathfit CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
    echo "✓ Database 'pathfit' created/verified\n";
    
    // Connect to the pathfit database
    $pdo = new PDO('mysql:host=127.0.0.1;port=3306;dbname=pathfit', 'root', '', [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);
    
    echo "✓ Connected to pathfit database\n";
    
    // Create users table
    $sql = "CREATE TABLE IF NOT EXISTS users (
        id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(255) NOT NULL,
        fname VARCHAR(255) NULL,
        mname VARCHAR(255) NULL,
        lname VARCHAR(255) NULL,
        course VARCHAR(255) NULL,
        gender ENUM('male', 'female') NULL,
        email VARCHAR(255) NOT NULL UNIQUE,
        email_verified_at TIMESTAMP NULL,
        password VARCHAR(255) NOT NULL,
        role VARCHAR(255) DEFAULT 'Athlete',
        remember_token VARCHAR(100) NULL,
        created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci";
    
    $pdo->exec($sql);
    echo "✓ Users table created\n";
    
    // Create migrations table
    $sql = "CREATE TABLE IF NOT EXISTS migrations (
        id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        migration VARCHAR(255) NOT NULL,
        batch INT NOT NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci";
    
    $pdo->exec($sql);
    echo "✓ Migrations table created\n";
    
    // Create cache table
    $sql = "CREATE TABLE IF NOT EXISTS cache (
        `key` VARCHAR(255) NOT NULL PRIMARY KEY,
        value MEDIUMTEXT NOT NULL,
        expiration INT NOT NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci";
    
    $pdo->exec($sql);
    echo "✓ Cache table created\n";
    
    // Create sessions table
    $sql = "CREATE TABLE IF NOT EXISTS sessions (
        id VARCHAR(255) NOT NULL PRIMARY KEY,
        user_id BIGINT UNSIGNED NULL,
        ip_address VARCHAR(45) NULL,
        user_agent TEXT NULL,
        payload LONGTEXT NOT NULL,
        last_activity INT NOT NULL,
        INDEX sessions_user_id_index (user_id),
        INDEX sessions_last_activity_index (last_activity)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci";
    
    $pdo->exec($sql);
    echo "✓ Sessions table created\n";
    
    // Create jobs table
    $sql = "CREATE TABLE IF NOT EXISTS jobs (
        id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        queue VARCHAR(255) NOT NULL,
        payload LONGTEXT NOT NULL,
        attempts TINYINT UNSIGNED NOT NULL,
        reserved_at INT UNSIGNED NULL,
        available_at INT UNSIGNED NOT NULL,
        created_at INT UNSIGNED NOT NULL,
        INDEX jobs_queue_index (queue)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci";
    
    $pdo->exec($sql);
    echo "✓ Jobs table created\n";
    
    echo "\n✅ Database setup completed successfully!\n";
    echo "You can now run the Laravel application.\n";
    
} catch (Exception $e) {
    echo "✗ Error: " . $e->getMessage() . "\n";
    exit(1);
}