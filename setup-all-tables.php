<?php

echo "Setting up complete PathFit database with all tables...\n";

try {
    $pdo = new PDO('sqlite:database/database.sqlite');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "✓ Connected to SQLite database\n";
    
    // Create sport_activities table
    $sql = "CREATE TABLE IF NOT EXISTS sport_activities (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        name TEXT NOT NULL,
        description TEXT,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
        updated_at DATETIME DEFAULT CURRENT_TIMESTAMP
    )";
    $pdo->exec($sql);
    echo "✓ sport_activities table created\n";
    
    // Create sport_availables table
    $sql = "CREATE TABLE IF NOT EXISTS sport_availables (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        name TEXT NOT NULL,
        description TEXT,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
        updated_at DATETIME DEFAULT CURRENT_TIMESTAMP
    )";
    $pdo->exec($sql);
    echo "✓ sport_availables table created\n";
    
    // Create training_schedules table
    $sql = "CREATE TABLE IF NOT EXISTS training_schedules (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        title TEXT NOT NULL,
        description TEXT,
        date DATE NOT NULL,
        start_time TIME NOT NULL,
        end_time TIME NOT NULL,
        coach_id INTEGER,
        user_id INTEGER,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
        updated_at DATETIME DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (coach_id) REFERENCES users(id),
        FOREIGN KEY (user_id) REFERENCES users(id)
    )";
    $pdo->exec($sql);
    echo "✓ training_schedules table created\n";
    
    // Create activity_reports table
    $sql = "CREATE TABLE IF NOT EXISTS activity_reports (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        user_id INTEGER NOT NULL,
        activity_date DATE NOT NULL,
        activity_type TEXT NOT NULL,
        duration INTEGER NOT NULL,
        description TEXT,
        performance_rating INTEGER,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
        updated_at DATETIME DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (user_id) REFERENCES users(id)
    )";
    $pdo->exec($sql);
    echo "✓ activity_reports table created\n";
    
    // Create messages table
    $sql = "CREATE TABLE IF NOT EXISTS messages (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        sender_id INTEGER NOT NULL,
        receiver_id INTEGER NOT NULL,
        content TEXT NOT NULL,
        is_read BOOLEAN DEFAULT 0,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
        updated_at DATETIME DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (sender_id) REFERENCES users(id),
        FOREIGN KEY (receiver_id) REFERENCES users(id)
    )";
    $pdo->exec($sql);
    echo "✓ messages table created\n";
    
    // Create session_schedules table
    $sql = "CREATE TABLE IF NOT EXISTS session_schedules (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        title TEXT NOT NULL,
        description TEXT,
        date DATE NOT NULL,
        start_time TIME NOT NULL,
        end_time TIME NOT NULL,
        coach_id INTEGER,
        athlete_id INTEGER,
        duration INTEGER,
        status TEXT DEFAULT 'scheduled',
        notes TEXT,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
        updated_at DATETIME DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (coach_id) REFERENCES users(id),
        FOREIGN KEY (athlete_id) REFERENCES users(id)
    )";
    $pdo->exec($sql);
    echo "✓ session_schedules table created\n";
    
    // Create sport_requirements table
    $sql = "CREATE TABLE IF NOT EXISTS sport_requirements (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        coach_id INTEGER NOT NULL,
        sport_available_id INTEGER NOT NULL,
        min_age INTEGER,
        max_age INTEGER,
        required_gender TEXT,
        min_height REAL,
        max_height REAL,
        min_weight REAL,
        max_weight REAL,
        min_experience_years INTEGER,
        required_level TEXT,
        required_positions TEXT,
        medical_restrictions TEXT,
        is_active BOOLEAN DEFAULT 1,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
        updated_at DATETIME DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (coach_id) REFERENCES users(id),
        FOREIGN KEY (sport_available_id) REFERENCES sport_availables(id)
    )";
    $pdo->exec($sql);
    echo "✓ sport_requirements table created\n";
    
    echo "\n✅ All tables created successfully!\n";
    
    // Show all tables
    $stmt = $pdo->query("SELECT name FROM sqlite_master WHERE type='table' AND name NOT LIKE 'sqlite_%' ORDER BY name");
    $tables = $stmt->fetchAll(PDO::FETCH_COLUMN);
    
    echo "\nAvailable tables:\n";
    foreach ($tables as $table) {
        echo "  - $table\n";
    }
    
} catch(Exception $e) {
    echo "✗ Error: " . $e->getMessage() . "\n";
    exit(1);
}