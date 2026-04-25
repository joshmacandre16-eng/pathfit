<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use App\Models\User;

echo "=== Railway MySQL Database Registration Test ===\n\n";

// Test 1: Database Connection
echo "1. Testing Database Connection...\n";
try {
    DB::connection()->getPdo();
    echo "   ✓ Database connected successfully\n";
    echo "   Connection: " . config('database.default') . "\n";
    echo "   Host: " . config('database.connections.mysql.host') . "\n";
    echo "   Database: " . config('database.connections.mysql.database') . "\n\n";
} catch (\Exception $e) {
    echo "   ✗ Database connection failed: " . $e->getMessage() . "\n\n";
    exit(1);
}

// Test 2: Check if users table exists
echo "2. Checking if users table exists...\n";
try {
    if (Schema::hasTable('users')) {
        echo "   ✓ Users table exists\n";
        $count = DB::table('users')->count();
        echo "   Current user count: $count\n\n";
    } else {
        echo "   ✗ Users table does not exist\n";
        echo "   Run: php artisan migrate\n\n";
        exit(1);
    }
} catch (\Exception $e) {
    echo "   ✗ Error checking table: " . $e->getMessage() . "\n\n";
    exit(1);
}

// Test 3: Check table structure
echo "3. Checking users table structure...\n";
try {
    $columns = Schema::getColumnListing('users');
    $requiredColumns = ['id', 'name', 'fname', 'lname', 'email', 'password', 'role', 'course', 'gender'];
    $missingColumns = array_diff($requiredColumns, $columns);
    
    if (empty($missingColumns)) {
        echo "   ✓ All required columns exist\n\n";
    } else {
        echo "   ✗ Missing columns: " . implode(', ', $missingColumns) . "\n\n";
        exit(1);
    }
} catch (\Exception $e) {
    echo "   ✗ Error checking columns: " . $e->getMessage() . "\n\n";
    exit(1);
}

// Test 4: Test User Creation
echo "4. Testing User Registration...\n";
try {
    $testEmail = 'test_' . time() . '@railway.test';
    
    $user = User::create([
        'name' => 'Test Railway User',
        'fname' => 'Test',
        'mname' => 'Railway',
        'lname' => 'User',
        'course' => 'Computer Science',
        'gender' => 'male',
        'email' => $testEmail,
        'password' => bcrypt('password123'),
        'role' => 'Athlete',
    ]);
    
    echo "   ✓ User created successfully\n";
    echo "   User ID: " . $user->id . "\n";
    echo "   Email: " . $user->email . "\n";
    echo "   Name: " . $user->name . "\n";
    echo "   Role: " . $user->role . "\n\n";
    
    // Test 5: Verify user was saved
    echo "5. Verifying user in database...\n";
    $savedUser = User::where('email', $testEmail)->first();
    
    if ($savedUser) {
        echo "   ✓ User found in database\n";
        echo "   Password is hashed: " . (strlen($savedUser->password) === 60 ? 'Yes' : 'No') . "\n\n";
        
        // Clean up test user
        echo "6. Cleaning up test user...\n";
        $savedUser->delete();
        echo "   ✓ Test user deleted\n\n";
    } else {
        echo "   ✗ User not found in database\n\n";
        exit(1);
    }
    
} catch (\Exception $e) {
    echo "   ✗ User creation failed: " . $e->getMessage() . "\n";
    echo "   Trace: " . $e->getTraceAsString() . "\n\n";
    exit(1);
}

echo "=== All Tests Passed! ===\n";
echo "Registration is working correctly on Railway MySQL database.\n";
