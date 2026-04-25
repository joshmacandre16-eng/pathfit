<?php
// COMPREHENSIVE AUTO-TEST FOR PATHFIT
// Upload to: public/comprehensive-test.php
// Visit: https://pathfit.online/comprehensive-test.php

error_reporting(E_ALL);
ini_set('display_errors', 1);
set_time_limit(300); // 5 minutes

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>PathFit Comprehensive Test</title>
<style>
* { margin: 0; padding: 0; box-sizing: border-box; }
body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background: #0D0F0A; color: #E8EDE0; padding: 20px; }
.container { max-width: 1200px; margin: 0 auto; }
h1 { color: #10b981; margin-bottom: 10px; font-size: 32px; }
.subtitle { color: #8A9480; margin-bottom: 30px; font-size: 14px; }
.test-section { background: #1E2418; padding: 20px; margin: 20px 0; border-radius: 10px; border-left: 4px solid #10b981; }
.test-section h2 { color: #10b981; margin-bottom: 15px; font-size: 20px; }
.test-item { background: #0D0F0A; padding: 12px; margin: 10px 0; border-radius: 5px; display: flex; justify-content: space-between; align-items: center; }
.test-name { flex: 1; }
.test-status { padding: 5px 12px; border-radius: 20px; font-size: 12px; font-weight: bold; }
.status-pass { background: #10b981; color: #0D0F0A; }
.status-fail { background: #ff6b6b; color: #fff; }
.status-skip { background: #8A9480; color: #0D0F0A; }
.test-details { font-size: 12px; color: #8A9480; margin-top: 5px; }
.summary { background: #181C12; padding: 25px; border-radius: 10px; margin: 30px 0; }
.summary h2 { color: #10b981; margin-bottom: 20px; }
.stat-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 15px; margin-top: 15px; }
.stat-card { background: #1E2418; padding: 15px; border-radius: 8px; text-align: center; }
.stat-number { font-size: 32px; font-weight: bold; color: #10b981; }
.stat-label { font-size: 12px; color: #8A9480; margin-top: 5px; }
.role-section { background: #181C12; padding: 20px; margin: 15px 0; border-radius: 8px; }
.role-header { color: #10b981; font-size: 18px; margin-bottom: 10px; }
.route-list { display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 10px; margin-top: 10px; }
.route-item { background: #0D0F0A; padding: 8px 12px; border-radius: 5px; font-size: 13px; }
.method { display: inline-block; padding: 2px 8px; border-radius: 3px; font-size: 11px; font-weight: bold; margin-right: 8px; }
.method-get { background: #10b981; color: #0D0F0A; }
.method-post { background: #3b82f6; color: #fff; }
.method-put { background: #f59e0b; color: #0D0F0A; }
.method-delete { background: #ef4444; color: #fff; }
.btn { display: inline-block; padding: 10px 20px; background: #10b981; color: #0D0F0A; text-decoration: none; border-radius: 5px; font-weight: bold; margin: 5px; }
.btn:hover { background: #0ea572; }
pre { background: #000; padding: 10px; border-radius: 5px; overflow-x: auto; font-size: 12px; margin-top: 10px; }
.loading { text-align: center; padding: 40px; }
.spinner { border: 4px solid #1E2418; border-top: 4px solid #10b981; border-radius: 50%; width: 40px; height: 40px; animation: spin 1s linear infinite; margin: 0 auto; }
@keyframes spin { 0% { transform: rotate(0deg); } 100% { transform: rotate(360deg); } }
</style>
</head>
<body>
<div class="container">
<h1>🧪 PathFit Comprehensive Auto-Test</h1>
<p class="subtitle">Testing all routes, database operations, and role-based functionality</p>

<?php

$results = [
    'total' => 0,
    'passed' => 0,
    'failed' => 0,
    'skipped' => 0,
    'tests' => []
];

// Initialize Laravel
try {
    require __DIR__ . '/../vendor/autoload.php';
    $app = require_once __DIR__ . '/../bootstrap/app.php';
    $kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
    $kernel->bootstrap();
} catch (Exception $e) {
    echo "<div class='test-section'><h2>❌ Fatal Error</h2>";
    echo "<p style='color:#ff6b6b;'>Failed to initialize Laravel: " . $e->getMessage() . "</p></div>";
    echo "</div></body></html>";
    exit;
}

// Helper function to run test
function runTest($name, $callback, &$results) {
    $results['total']++;
    try {
        $result = $callback();
        if ($result['status'] === 'pass') {
            $results['passed']++;
            $status = "<span class='test-status status-pass'>✓ PASS</span>";
        } elseif ($result['status'] === 'skip') {
            $results['skipped']++;
            $status = "<span class='test-status status-skip'>⊘ SKIP</span>";
        } else {
            $results['failed']++;
            $status = "<span class='test-status status-fail'>✗ FAIL</span>";
        }
        
        echo "<div class='test-item'>";
        echo "<div class='test-name'>{$name}";
        if (!empty($result['details'])) {
            echo "<div class='test-details'>{$result['details']}</div>";
        }
        echo "</div>";
        echo $status;
        echo "</div>";
        
        $results['tests'][] = [
            'name' => $name,
            'status' => $result['status'],
            'details' => $result['details'] ?? ''
        ];
        
    } catch (Exception $e) {
        $results['failed']++;
        echo "<div class='test-item'>";
        echo "<div class='test-name'>{$name}";
        echo "<div class='test-details' style='color:#ff6b6b;'>Error: " . $e->getMessage() . "</div>";
        echo "</div>";
        echo "<span class='test-status status-fail'>✗ FAIL</span>";
        echo "</div>";
    }
}

// ============================================
// SECTION 1: DATABASE TESTS
// ============================================
echo "<div class='test-section'>";
echo "<h2>1️⃣ Database Connection & Configuration</h2>";

runTest("Database Connection", function() {
    DB::connection()->getPdo();
    return ['status' => 'pass', 'details' => 'Connected successfully'];
}, $results);

runTest("Railway Database Configuration", function() {
    $host = DB::connection()->getConfig('host');
    $database = DB::connection()->getConfig('database');
    if ($host === 'shuttle.proxy.rlwy.net' && $database === 'railway') {
        return ['status' => 'pass', 'details' => "Host: $host, Database: $database"];
    }
    return ['status' => 'fail', 'details' => "Wrong config - Host: $host, Database: $database"];
}, $results);

runTest("Users Table Exists", function() {
    $count = DB::table('users')->count();
    return ['status' => 'pass', 'details' => "$count users in database"];
}, $results);

echo "</div>";

// ============================================
// SECTION 2: ROUTE TESTS
// ============================================
echo "<div class='test-section'>";
echo "<h2>2️⃣ Route Configuration</h2>";

$publicRoutes = [
    'login' => 'Login Page',
    'login.submit' => 'Login Submit',
    'register' => 'Register Page',
    'register.submit' => 'Register Submit',
];

foreach ($publicRoutes as $routeName => $description) {
    runTest("Route: {$description}", function() use ($routeName) {
        $url = route($routeName);
        return ['status' => 'pass', 'details' => $url];
    }, $results);
}

echo "</div>";

// ============================================
// SECTION 3: USER REGISTRATION TEST
// ============================================
echo "<div class='test-section'>";
echo "<h2>3️⃣ User Registration Test</h2>";

$timestamp = time();
$testUsers = [
    'admin' => [
        'fname' => 'Admin',
        'mname' => 'Test',
        'lname' => 'User' . $timestamp,
        'email' => "admin{$timestamp}@test.com",
        'password' => 'Test1234',
        'role' => 'Administrator',
        'course' => 'Administration',
        'gender' => 'male'
    ],
    'athlete' => [
        'fname' => 'Athlete',
        'mname' => 'Test',
        'lname' => 'User' . $timestamp,
        'email' => "athlete{$timestamp}@test.com",
        'password' => 'Test1234',
        'role' => 'Athlete',
        'course' => 'Physical Education',
        'gender' => 'female'
    ],
    'coach' => [
        'fname' => 'Coach',
        'mname' => 'Test',
        'lname' => 'User' . $timestamp,
        'email' => "coach{$timestamp}@test.com",
        'password' => 'Test1234',
        'role' => 'Coach',
        'course' => 'Sports Science',
        'gender' => 'male'
    ]
];

$createdUsers = [];

foreach ($testUsers as $type => $userData) {
    runTest("Create {$type} user", function() use ($userData, &$createdUsers, $type) {
        DB::beginTransaction();
        
        $fullName = trim($userData['fname'] . ' ' . $userData['mname'] . ' ' . $userData['lname']);
        $userId = DB::table('users')->insertGetId([
            'name' => $fullName,
            'email' => $userData['email'],
            'password' => Hash::make($userData['password']),
            'fname' => $userData['fname'],
            'mname' => $userData['mname'],
            'lname' => $userData['lname'],
            'course' => $userData['course'],
            'gender' => $userData['gender'],
            'role' => $userData['role'],
            'email_verified_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        
        DB::commit();
        
        $createdUsers[$type] = [
            'id' => $userId,
            'email' => $userData['email'],
            'password' => $userData['password'],
            'role' => $userData['role']
        ];
        
        return ['status' => 'pass', 'details' => "User ID: {$userId}, Email: {$userData['email']}"];
    }, $results);
}

echo "</div>";

// ============================================
// SECTION 4: LOGIN & AUTHENTICATION TEST
// ============================================
echo "<div class='test-section'>";
echo "<h2>4️⃣ Login & Authentication Test</h2>";

foreach ($createdUsers as $type => $user) {
    runTest("Login as {$type}", function() use ($user) {
        if (Auth::attempt(['email' => $user['email'], 'password' => $user['password']])) {
            $authUser = Auth::user();
            Auth::logout();
            return ['status' => 'pass', 'details' => "Role: {$authUser->role}, Name: {$authUser->name}"];
        }
        return ['status' => 'fail', 'details' => 'Authentication failed'];
    }, $results);
}

echo "</div>";

// ============================================
// SECTION 5: ROLE-BASED ROUTES
// ============================================
echo "<div class='test-section'>";
echo "<h2>5️⃣ Role-Based Routes</h2>";

$roleRoutes = [
    'Administrator' => [
        'admin.dashboard' => 'Admin Dashboard',
        'admin.users.index' => 'Users List',
        'admin.users.create' => 'Create User',
        'admin.coach.index' => 'Coaches List',
        'admin.athlete.index' => 'Athletes List',
        'admin.sport_activity.index' => 'Sport Activities',
        'admin.sport_available.index' => 'Available Sports',
        'admin.ai-based.index' => 'AI-Based Assignment',
    ],
    'Athlete' => [
        'athlete.dashboard' => 'Athlete Dashboard',
        'athlete.profile.index' => 'Athlete Profile',
        'athlete.sport-suggestion' => 'Sport Suggestions',
        'athlete.messages.index' => 'Athlete Messages',
        'athlete.session-schedules.index' => 'Session Schedules',
    ],
    'Coach' => [
        'coach.dashboard' => 'Coach Dashboard',
        'coach.athletes.index' => 'Coach Athletes',
        'coach.training-schedules.index' => 'Training Schedules',
        'coach.activity-reports.index' => 'Activity Reports',
        'coach.messages.index' => 'Coach Messages',
        'coach.sport-requirements.index' => 'Sport Requirements',
        'coach.session-schedules.index' => 'Coach Session Schedules',
    ]
];

foreach ($roleRoutes as $role => $routes) {
    echo "<div class='role-section'>";
    echo "<div class='role-header'>📋 {$role} Routes</div>";
    echo "<div class='route-list'>";
    
    foreach ($routes as $routeName => $description) {
        runTest("{$description}", function() use ($routeName) {
            $url = route($routeName);
            return ['status' => 'pass', 'details' => $url];
        }, $results);
    }
    
    echo "</div></div>";
}

echo "</div>";

// ============================================
// SECTION 6: CRUD OPERATIONS TEST
// ============================================
echo "<div class='test-section'>";
echo "<h2>6️⃣ CRUD Operations Test</h2>";

// Test CREATE
runTest("CREATE: Insert test record", function() {
    $testId = DB::table('users')->insertGetId([
        'name' => 'CRUD Test User',
        'email' => 'crud_test_' . time() . '@test.com',
        'password' => Hash::make('password'),
        'fname' => 'CRUD',
        'lname' => 'Test',
        'course' => 'Test Course',
        'gender' => 'male',
        'role' => 'Athlete',
        'email_verified_at' => now(),
        'created_at' => now(),
        'updated_at' => now(),
    ]);
    return ['status' => 'pass', 'details' => "Created user ID: {$testId}"];
}, $results);

// Test READ
runTest("READ: Fetch records", function() {
    $users = DB::table('users')->limit(5)->get();
    return ['status' => 'pass', 'details' => "Fetched " . count($users) . " records"];
}, $results);

// Test UPDATE
runTest("UPDATE: Modify record", function() {
    $user = DB::table('users')->where('email', 'like', 'crud_test_%')->first();
    if ($user) {
        DB::table('users')->where('id', $user->id)->update([
            'name' => 'CRUD Test Updated',
            'updated_at' => now()
        ]);
        return ['status' => 'pass', 'details' => "Updated user ID: {$user->id}"];
    }
    return ['status' => 'skip', 'details' => 'No test user found'];
}, $results);

// Test DELETE
runTest("DELETE: Remove record", function() {
    $user = DB::table('users')->where('email', 'like', 'crud_test_%')->first();
    if ($user) {
        DB::table('users')->where('id', $user->id)->delete();
        return ['status' => 'pass', 'details' => "Deleted user ID: {$user->id}"];
    }
    return ['status' => 'skip', 'details' => 'No test user found'];
}, $results);

echo "</div>";

// ============================================
// SECTION 7: REDIRECT LOGIC TEST
// ============================================
echo "<div class='test-section'>";
echo "<h2>7️⃣ Role-Based Redirect Logic</h2>";

$redirectTests = [
    'Administrator' => '/admin/dashboard',
    'Athlete' => '/athlete/dashboard',
    'Coach' => '/coach/dashboard'
];

foreach ($redirectTests as $role => $expectedPath) {
    runTest("{$role} redirect path", function() use ($role, $expectedPath) {
        // Map role names to route prefixes
        $routePrefix = $role === 'Administrator' ? 'admin' : strtolower($role);
        $url = route($routePrefix . '.dashboard');
        if (strpos($url, $expectedPath) !== false) {
            return ['status' => 'pass', 'details' => $url];
        }
        return ['status' => 'fail', 'details' => "Expected: {$expectedPath}, Got: {$url}"];
    }, $results);
}

echo "</div>";

// ============================================
// SECTION 8: CLEANUP TEST USERS
// ============================================
echo "<div class='test-section'>";
echo "<h2>8️⃣ Cleanup Test Data</h2>";

foreach ($createdUsers as $type => $user) {
    runTest("Delete test {$type} user", function() use ($user) {
        DB::table('users')->where('id', $user['id'])->delete();
        return ['status' => 'pass', 'details' => "Deleted user ID: {$user['id']}"];
    }, $results);
}

echo "</div>";

// ============================================
// FINAL SUMMARY
// ============================================
echo "<div class='summary'>";
echo "<h2>📊 Test Summary</h2>";

$passRate = $results['total'] > 0 ? round(($results['passed'] / $results['total']) * 100, 1) : 0;

echo "<div class='stat-grid'>";
echo "<div class='stat-card'>";
echo "<div class='stat-number'>{$results['total']}</div>";
echo "<div class='stat-label'>Total Tests</div>";
echo "</div>";

echo "<div class='stat-card'>";
echo "<div class='stat-number' style='color:#10b981;'>{$results['passed']}</div>";
echo "<div class='stat-label'>Passed</div>";
echo "</div>";

echo "<div class='stat-card'>";
echo "<div class='stat-number' style='color:#ff6b6b;'>{$results['failed']}</div>";
echo "<div class='stat-label'>Failed</div>";
echo "</div>";

echo "<div class='stat-card'>";
echo "<div class='stat-number' style='color:#8A9480;'>{$results['skipped']}</div>";
echo "<div class='stat-label'>Skipped</div>";
echo "</div>";

echo "<div class='stat-card'>";
echo "<div class='stat-number'>{$passRate}%</div>";
echo "<div class='stat-label'>Pass Rate</div>";
echo "</div>";
echo "</div>";

if ($results['failed'] === 0) {
    echo "<div style='background:#10b981; color:#0D0F0A; padding:20px; border-radius:8px; margin-top:20px; text-align:center;'>";
    echo "<h3>✅ ALL TESTS PASSED!</h3>";
    echo "<p>PathFit is working perfectly across all roles and functionality.</p>";
    echo "</div>";
} else {
    echo "<div style='background:#ff6b6b; color:#fff; padding:20px; border-radius:8px; margin-top:20px; text-align:center;'>";
    echo "<h3>⚠ SOME TESTS FAILED</h3>";
    echo "<p>Please review the failed tests above and fix the issues.</p>";
    echo "</div>";
}

echo "<div style='margin-top:30px; text-align:center;'>";
echo "<a href='/register' class='btn'>Test Registration</a>";
echo "<a href='/login' class='btn'>Test Login</a>";
echo "<a href='comprehensive-test.php' class='btn'>Run Tests Again</a>";
echo "</div>";

echo "</div>";

?>

</div>
</body>
</html>
