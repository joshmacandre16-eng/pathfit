<?php
// Upload to: public/auto-register-test.php
// Visit: https://pathfit.online/auto-register-test.php

error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<h1>Auto Registration Test</h1><hr>";

try {
    require __DIR__ . '/../vendor/autoload.php';
    $app = require_once __DIR__ . '/../bootstrap/app.php';
    $kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
    $kernel->bootstrap();
    
    // Generate unique test data
    $timestamp = time();
    $testData = [
        'fname' => 'TestUser',
        'mname' => 'Auto',
        'lname' => 'Registration',
        'course' => 'Computer Science',
        'gender' => 'male',
        'email' => "autotest{$timestamp}@test.com",
        'password' => 'Test1234',
    ];
    
    echo "<h2>1. Test Data</h2>";
    echo "First Name: {$testData['fname']}<br>";
    echo "Middle Name: {$testData['mname']}<br>";
    echo "Last Name: {$testData['lname']}<br>";
    echo "Course: {$testData['course']}<br>";
    echo "Gender: {$testData['gender']}<br>";
    echo "Email: {$testData['email']}<br>";
    echo "Password: {$testData['password']}<br>";
    
    // Check database connection
    echo "<h2>2. Database Connection</h2>";
    $pdo = DB::connection()->getPdo();
    $dbHost = DB::connection()->getConfig('host');
    $dbName = DB::connection()->getConfig('database');
    echo "<span style='color:green'>✓ Connected to: $dbHost / $dbName</span><br>";
    
    // Count users before
    $usersBefore = DB::table('users')->count();
    echo "<h2>3. Users Before Registration</h2>";
    echo "Total users: <strong>$usersBefore</strong><br>";
    
    // Attempt registration
    echo "<h2>4. Registration Process</h2>";
    
    DB::beginTransaction();
    
    $fullName = trim($testData['fname'] . ' ' . $testData['mname'] . ' ' . $testData['lname']);
    
    $userId = DB::table('users')->insertGetId([
        'name' => $fullName,
        'email' => $testData['email'],
        'password' => Hash::make($testData['password']),
        'fname' => $testData['fname'],
        'mname' => $testData['mname'],
        'lname' => $testData['lname'],
        'course' => $testData['course'],
        'gender' => $testData['gender'],
        'role' => 'Athlete',
        'email_verified_at' => now(),
        'created_at' => now(),
        'updated_at' => now(),
    ]);
    
    DB::commit();
    
    echo "<span style='color:green; font-size:18px;'>✓ User created with ID: $userId</span><br>";
    
    // Count users after
    $usersAfter = DB::table('users')->count();
    echo "<h2>5. Users After Registration</h2>";
    echo "Total users: <strong>$usersAfter</strong><br>";
    echo "New users added: <strong>" . ($usersAfter - $usersBefore) . "</strong><br>";
    
    // Verify the user exists
    echo "<h2>6. Verify User in Database</h2>";
    $user = DB::table('users')->where('id', $userId)->first();
    
    if ($user) {
        echo "<span style='color:green'>✓ User found in database!</span><br>";
        echo "<table border='1' cellpadding='5' style='margin-top:10px;'>";
        echo "<tr><th>Field</th><th>Value</th></tr>";
        echo "<tr><td>ID</td><td>{$user->id}</td></tr>";
        echo "<tr><td>Name</td><td>{$user->name}</td></tr>";
        echo "<tr><td>Email</td><td>{$user->email}</td></tr>";
        echo "<tr><td>First Name</td><td>{$user->fname}</td></tr>";
        echo "<tr><td>Middle Name</td><td>{$user->mname}</td></tr>";
        echo "<tr><td>Last Name</td><td>{$user->lname}</td></tr>";
        echo "<tr><td>Course</td><td>{$user->course}</td></tr>";
        echo "<tr><td>Gender</td><td>{$user->gender}</td></tr>";
        echo "<tr><td>Role</td><td>{$user->role}</td></tr>";
        echo "<tr><td>Created At</td><td>{$user->created_at}</td></tr>";
        echo "</table>";
    } else {
        echo "<span style='color:red'>✗ User NOT found in database!</span><br>";
    }
    
    // Test if we can query all users
    echo "<h2>7. Recent Users (Last 5)</h2>";
    $recentUsers = DB::table('users')->orderBy('id', 'desc')->limit(5)->get();
    echo "<table border='1' cellpadding='5'>";
    echo "<tr><th>ID</th><th>Name</th><th>Email</th><th>Role</th><th>Created</th></tr>";
    foreach ($recentUsers as $u) {
        $highlight = ($u->id == $userId) ? "style='background:yellow;'" : "";
        echo "<tr $highlight>";
        echo "<td>{$u->id}</td>";
        echo "<td>{$u->name}</td>";
        echo "<td>{$u->email}</td>";
        echo "<td>{$u->role}</td>";
        echo "<td>{$u->created_at}</td>";
        echo "</tr>";
    }
    echo "</table>";
    
    // Final result
    echo "<hr><h2>FINAL RESULT</h2>";
    if ($user && $usersAfter > $usersBefore) {
        echo "<div style='background:green; color:white; padding:20px; font-size:18px;'>";
        echo "<strong>✓ REGISTRATION WORKS PERFECTLY!</strong><br>";
        echo "User was created and stored in database successfully.<br>";
        echo "Database: $dbHost / $dbName<br>";
        echo "</div>";
        
        echo "<h3>Now test manual registration:</h3>";
        echo "<a href='/register' style='padding:10px 20px; background:blue; color:white; text-decoration:none;'>Go to Registration Form</a>";
    } else {
        echo "<div style='background:red; color:white; padding:20px; font-size:18px;'>";
        echo "<strong>✗ REGISTRATION FAILED!</strong><br>";
        echo "User was not stored properly.<br>";
        echo "</div>";
    }
    
} catch (Exception $e) {
    echo "<div style='background:red; color:white; padding:20px;'>";
    echo "<h2>ERROR!</h2>";
    echo "<p><strong>Message:</strong> " . $e->getMessage() . "</p>";
    echo "<p><strong>File:</strong> " . $e->getFile() . "</p>";
    echo "<p><strong>Line:</strong> " . $e->getLine() . "</p>";
    echo "<pre>" . $e->getTraceAsString() . "</pre>";
    echo "</div>";
    
    if (isset($userId)) {
        DB::rollBack();
    }
}
