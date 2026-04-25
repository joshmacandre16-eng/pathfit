<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\User;
use Illuminate\Support\Facades\DB;

echo "Testing Registration Data Storage\n";
echo "==================================\n\n";

// Test database connection
try {
    DB::connection()->getPdo();
    echo "✓ Database connected successfully\n";
    echo "  Database: " . config('database.connections.mysql.database') . "\n\n";
} catch (\Exception $e) {
    echo "✗ Database connection failed: " . $e->getMessage() . "\n";
    exit(1);
}

// Test user creation (simulating registration)
try {
    $testEmail = 'test_' . time() . '@example.com';
    
    $user = User::create([
        'name' => 'Test User',
        'fname' => 'Test',
        'mname' => 'Middle',
        'lname' => 'User',
        'course' => 'Computer Science',
        'gender' => 'male',
        'email' => $testEmail,
        'password' => 'password123',
        'role' => 'Athlete',
    ]);
    
    echo "✓ User created successfully\n";
    echo "  ID: " . $user->id . "\n";
    echo "  Name: " . $user->name . "\n";
    echo "  Email: " . $user->email . "\n";
    echo "  Role: " . $user->role . "\n\n";
    
    // Verify user exists in database
    $dbUser = User::where('email', $testEmail)->first();
    if ($dbUser) {
        echo "✓ User verified in database\n";
        echo "  Password is hashed: " . (strlen($dbUser->password) > 50 ? 'Yes' : 'No') . "\n\n";
    } else {
        echo "✗ User not found in database\n\n";
    }
    
    // Clean up test user
    $user->delete();
    echo "✓ Test user cleaned up\n\n";
    
    echo "==================================\n";
    echo "Registration can store data: YES\n";
    echo "==================================\n";
    
} catch (\Exception $e) {
    echo "✗ User creation failed: " . $e->getMessage() . "\n";
    echo "\nStack trace:\n" . $e->getTraceAsString() . "\n";
    exit(1);
}
