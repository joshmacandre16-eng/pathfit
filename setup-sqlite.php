<?php

echo "Setting up SQLite database for PathFit...\n";

try {
    $dbPath = __DIR__ . '/database/database.sqlite';
    
    // Create database file if it doesn't exist
    if (!file_exists($dbPath)) {
        touch($dbPath);
        echo "✓ Created SQLite database file\n";
    }
    
    // Connect to SQLite database
    $pdo = new PDO('sqlite:' . $dbPath, null, null, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);
    
    echo "✓ Connected to SQLite database\n";
    
    // Create users table
    $sql = "CREATE TABLE IF NOT EXISTS users (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        name TEXT NOT NULL,
        fname TEXT,
        mname TEXT,
        lname TEXT,
        course TEXT,
        gender TEXT CHECK(gender IN ('male', 'female')),
        email TEXT NOT NULL UNIQUE,
        email_verified_at DATETIME,
        password TEXT NOT NULL,
        role TEXT DEFAULT 'Athlete',
        remember_token TEXT,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
        updated_at DATETIME DEFAULT CURRENT_TIMESTAMP
    )";
    
    $pdo->exec($sql);
    echo "✓ Users table created\n";
    
    // Create migrations table
    $sql = "CREATE TABLE IF NOT EXISTS migrations (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        migration TEXT NOT NULL,
        batch INTEGER NOT NULL
    )";
    
    $pdo->exec($sql);
    echo "✓ Migrations table created\n";
    
    // Create cache table
    $sql = "CREATE TABLE IF NOT EXISTS cache (
        key TEXT PRIMARY KEY,
        value TEXT NOT NULL,
        expiration INTEGER NOT NULL
    )";
    
    $pdo->exec($sql);
    echo "✓ Cache table created\n";
    
    // Create sessions table
    $sql = "CREATE TABLE IF NOT EXISTS sessions (
        id TEXT PRIMARY KEY,
        user_id INTEGER,
        ip_address TEXT,
        user_agent TEXT,
        payload TEXT NOT NULL,
        last_activity INTEGER NOT NULL
    )";
    
    $pdo->exec($sql);
    echo "✓ Sessions table created\n";
    
    // Create jobs table
    $sql = "CREATE TABLE IF NOT EXISTS jobs (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        queue TEXT NOT NULL,
        payload TEXT NOT NULL,
        attempts INTEGER NOT NULL,
        reserved_at INTEGER,
        available_at INTEGER NOT NULL,
        created_at INTEGER NOT NULL
    )";
    
    $pdo->exec($sql);
    echo "✓ Jobs table created\n";
    
    // Insert a test user
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE email = ?");
    $stmt->execute(['admin@pathfit.com']);
    
    if ($stmt->fetchColumn() == 0) {
        $stmt = $pdo->prepare("INSERT INTO users (name, fname, lname, email, password, role) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([
            'Admin User',
            'Admin',
            'User',
            'admin@pathfit.com',
            password_hash('password123', PASSWORD_DEFAULT),
            'Admin'
        ]);
        echo "✓ Test admin user created (email: admin@pathfit.com, password: password123)\n";
    }
    
    echo "\n✅ SQLite database setup completed successfully!\n";
    echo "You can now run the Laravel application.\n";
    
} catch (Exception $e) {
    echo "✗ Error: " . $e->getMessage() . "\n";
    exit(1);
}