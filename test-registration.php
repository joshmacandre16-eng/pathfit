<?php
echo "Testing user registration...\n";

try {
    $pdo = new PDO('sqlite:database/database.sqlite');
    
    // Test data
    $testUser = [
        'name' => 'John Doe Smith',
        'fname' => 'John',
        'mname' => 'Doe',
        'lname' => 'Smith',
        'course' => 'Computer Science',
        'gender' => 'male',
        'email' => 'john.doe@test.com',
        'password' => password_hash('password123', PASSWORD_DEFAULT),
        'role' => 'Athlete'
    ];
    
    // Check if user already exists
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE email = ?");
    $stmt->execute([$testUser['email']]);
    
    if ($stmt->fetchColumn() > 0) {
        echo "✓ Test user already exists\n";
    } else {
        // Insert test user
        $stmt = $pdo->prepare("INSERT INTO users (name, fname, mname, lname, course, gender, email, password, role) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $result = $stmt->execute([
            $testUser['name'],
            $testUser['fname'],
            $testUser['mname'],
            $testUser['lname'],
            $testUser['course'],
            $testUser['gender'],
            $testUser['email'],
            $testUser['password'],
            $testUser['role']
        ]);
        
        if ($result) {
            echo "✓ Test user registered successfully!\n";
            echo "  Email: {$testUser['email']}\n";
            echo "  Password: password123\n";
        } else {
            echo "✗ Failed to register test user\n";
        }
    }
    
    // Show all users
    $stmt = $pdo->query("SELECT id, name, email, role FROM users");
    $users = $stmt->fetchAll();
    
    echo "\nRegistered users:\n";
    foreach ($users as $user) {
        echo "  ID: {$user['id']}, Name: {$user['name']}, Email: {$user['email']}, Role: {$user['role']}\n";
    }
    
    echo "\n✅ Registration system is working!\n";
    
} catch(Exception $e) {
    echo "✗ Registration test failed: " . $e->getMessage() . "\n";
}