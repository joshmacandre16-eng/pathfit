<?php
echo "Checking existing tables in database...\n";

try {
    $pdo = new PDO('sqlite:database/database.sqlite');
    
    $stmt = $pdo->query("SELECT name FROM sqlite_master WHERE type='table' ORDER BY name");
    $tables = $stmt->fetchAll(PDO::FETCH_COLUMN);
    
    echo "Existing tables:\n";
    foreach ($tables as $table) {
        echo "  - $table\n";
        
        // Get table structure
        $stmt = $pdo->query("PRAGMA table_info($table)");
        $columns = $stmt->fetchAll();
        echo "    Columns: ";
        $columnNames = array_map(function($col) { return $col['name']; }, $columns);
        echo implode(', ', $columnNames) . "\n";
    }
    
} catch(Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}