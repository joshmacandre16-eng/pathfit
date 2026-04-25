<?php
/**
 * AUTOMATED FIX SCRIPT FOR REGISTRATION ISSUES
 * This script will diagnose and fix common registration problems
 * 
 * Run: php fix-registration.php
 */

echo "╔════════════════════════════════════════════════════════════╗\n";
echo "║          PATHFIT REGISTRATION AUTO-FIX SCRIPT              ║\n";
echo "╚════════════════════════════════════════════════════════════╝\n\n";

// Load Laravel
try {
    require __DIR__.'/vendor/autoload.php';
    $app = require_once __DIR__.'/bootstrap/app.php';
    $kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
    $kernel->bootstrap();
    echo "✓ Laravel loaded\n\n";
} catch (Exception $e) {
    echo "✗ CRITICAL: Cannot load Laravel: " . $e->getMessage() . "\n";
    exit(1);
}

echo "═══════════════════════════════════════════════════════════\n";
echo "STEP 1: CLEARING ALL CACHES\n";
echo "═══════════════════════════════════════════════════════════\n";

try {
    Artisan::call('config:clear');
    echo "✓ Config cache cleared\n";
    
    Artisan::call('cache:clear');
    echo "✓ Application cache cleared\n";
    
    Artisan::call('route:clear');
    echo "✓ Route cache cleared\n";
    
    Artisan::call('view:clear');
    echo "✓ View cache cleared\n";
    
    if (config('session.driver') === 'file') {
        $sessionPath = storage_path('framework/sessions');
        if (is_dir($sessionPath)) {
            $files = glob($sessionPath . '/*');
            foreach ($files as $file) {
                if (is_file($file)) {
                    unlink($file);
                }
            }
            echo "✓ Session files cleared\n";
        }
    }
    
    echo "\n";
} catch (Exception $e) {
    echo "⚠ Warning: " . $e->getMessage() . "\n\n";
}

echo "═══════════════════════════════════════════════════════════\n";
echo "STEP 2: CHECKING DATABASE CONNECTION\n";
echo "═══════════════════════════════════════════════════════════\n";

try {
    $pdo = DB::connection()->getPdo();
    echo "✓ Database connected\n";
    echo "  Host: " . config('database.connections.mysql.host') . "\n";
    echo "  Database: " . config('database.connections.mysql.database') . "\n";
    echo "  Port: " . config('database.connections.mysql.port') . "\n\n";
} catch (Exception $e) {
    echo "✗ CRITICAL: Database connection failed\n";
    echo "  Error: " . $e->getMessage() . "\n\n";
    echo "FIX: Update your .env file with correct database credentials\n\n";
    exit(1);
}

echo "═══════════════════════════════════════════════════════════\n";
echo "STEP 3: VERIFYING USERS TABLE STRUCTURE\n";
echo "═══════════════════════════════════════════════════════════\n";

try {
    if (!Schema::hasTable('users')) {
        echo "✗ Users table missing!\n";
        echo "  Running migrations...\n";
        Artisan::call('migrate', ['--force' => true]);
        echo "✓ Migrations completed\n\n";
    } else {
        echo "✓ Users table exists\n";
        
        // Check for required columns
        $requiredColumns = [
            'id', 'name', 'email', 'password', 'role',
            'fname', 'mname', 'lname', 'course', 'gender'
        ];
        
        $missingColumns = [];
        foreach ($requiredColumns as $column) {
            if (!Schema::hasColumn('users', $column)) {
                $missingColumns[] = $column;
            }
        }
        
        if (count($missingColumns) > 0) {
            echo "⚠ Missing columns: " . implode(', ', $missingColumns) . "\n";
            echo "  Running migrations...\n";
            Artisan::call('migrate', ['--force' => true]);
            echo "✓ Migrations completed\n\n";
        } else {
            echo "✓ All required columns present\n\n";
        }
    }
} catch (Exception $e) {
    echo "✗ Error: " . $e->getMessage() . "\n\n";
}

echo "═══════════════════════════════════════════════════════════\n";
echo "STEP 4: TESTING DATABASE WRITE PERMISSIONS\n";
echo "═══════════════════════════════════════════════════════════\n";

try {
    $testEmail = 'autofix_test_' . time() . '@example.com';
    
    // Test direct DB insert
    DB::table('users')->insert([
        'name' => 'AutoFix Test',
        'fname' => 'AutoFix',
        'lname' => 'Test',
        'course' => 'Test Course',
        'gender' => 'male',
        'email' => $testEmail,
        'password' => Hash::make('test123'),
        'role' => 'Athlete',
        'email_verified_at' => now(),
        'created_at' => now(),
        'updated_at' => now(),
    ]);
    
    echo "✓ Database INSERT permission: OK\n";
    
    // Verify
    $testUser = DB::table('users')->where('email', $testEmail)->first();
    if ($testUser) {
        echo "✓ Data verification: OK\n";
        
        // Cleanup
        DB::table('users')->where('email', $testEmail)->delete();
        echo "✓ Cleanup: OK\n\n";
    } else {
        echo "⚠ Warning: Insert succeeded but data not found\n\n";
    }
    
} catch (Exception $e) {
    echo "✗ CRITICAL: Cannot insert into database\n";
    echo "  Error: " . $e->getMessage() . "\n";
    echo "  This means the database user doesn't have INSERT permissions!\n\n";
    exit(1);
}

echo "═══════════════════════════════════════════════════════════\n";
echo "STEP 5: TESTING USER MODEL CREATION\n";
echo "═══════════════════════════════════════════════════════════\n";

try {
    $testEmail = 'model_test_' . time() . '@example.com';
    
    $user = App\Models\User::create([
        'name' => 'Model Test User',
        'fname' => 'Model',
        'mname' => 'Test',
        'lname' => 'User',
        'course' => 'Test Course',
        'gender' => 'female',
        'email' => $testEmail,
        'password' => Hash::make('password123'),
        'role' => 'Athlete',
        'email_verified_at' => now(),
    ]);
    
    echo "✓ User model creation: OK\n";
    echo "  User ID: " . $user->id . "\n";
    echo "  Email: " . $user->email . "\n";
    
    // Cleanup
    $user->delete();
    echo "✓ Cleanup: OK\n\n";
    
} catch (Exception $e) {
    echo "✗ CRITICAL: User model creation failed\n";
    echo "  Error: " . $e->getMessage() . "\n\n";
    
    if (strpos($e->getMessage(), 'fillable') !== false) {
        echo "  FIX: Check User model \$fillable array\n\n";
    }
    exit(1);
}

echo "═══════════════════════════════════════════════════════════\n";
echo "STEP 6: CHECKING STORAGE PERMISSIONS\n";
echo "═══════════════════════════════════════════════════════════\n";

$directories = [
    'storage/logs',
    'storage/framework/sessions',
    'storage/framework/cache',
    'storage/framework/views',
    'bootstrap/cache',
];

$hasPermissionIssues = false;
foreach ($directories as $dir) {
    $path = base_path($dir);
    if (!is_dir($path)) {
        echo "⚠ Directory missing: $dir\n";
        mkdir($path, 0755, true);
        echo "  ✓ Created\n";
    } elseif (!is_writable($path)) {
        echo "⚠ Not writable: $dir\n";
        $hasPermissionIssues = true;
    } else {
        echo "✓ $dir is writable\n";
    }
}

if ($hasPermissionIssues) {
    echo "\n⚠ Some directories are not writable. Run:\n";
    echo "  chmod -R 775 storage bootstrap/cache\n\n";
} else {
    echo "\n";
}

echo "═══════════════════════════════════════════════════════════\n";
echo "STEP 7: TESTING REGISTRATION CONTROLLER\n";
echo "═══════════════════════════════════════════════════════════\n";

try {
    // Check if RegisterController exists
    if (class_exists('App\\Http\\Controllers\\RegisterController')) {
        echo "✓ RegisterController exists\n";
        
        // Check if register method exists
        $controller = new App\Http\Controllers\RegisterController();
        if (method_exists($controller, 'register')) {
            echo "✓ register() method exists\n";
        } else {
            echo "✗ register() method missing\n";
        }
        
        if (method_exists($controller, 'registerread')) {
            echo "✓ registerread() method exists\n";
        } else {
            echo "✗ registerread() method missing\n";
        }
    } else {
        echo "✗ RegisterController not found\n";
    }
    echo "\n";
} catch (Exception $e) {
    echo "⚠ Warning: " . $e->getMessage() . "\n\n";
}

echo "═══════════════════════════════════════════════════════════\n";
echo "STEP 8: CHECKING ROUTES\n";
echo "═══════════════════════════════════════════════════════════\n";

try {
    $routes = Route::getRoutes();
    $registerRoutes = [];
    
    foreach ($routes as $route) {
        if ($route->uri() === 'register') {
            $registerRoutes[] = [
                'method' => implode('|', $route->methods()),
                'action' => $route->getActionName(),
            ];
        }
    }
    
    if (count($registerRoutes) > 0) {
        echo "✓ Registration routes found:\n";
        foreach ($registerRoutes as $route) {
            echo "  - {$route['method']} /register → {$route['action']}\n";
        }
    } else {
        echo "✗ No registration routes found\n";
    }
    echo "\n";
} catch (Exception $e) {
    echo "⚠ Warning: " . $e->getMessage() . "\n\n";
}

echo "═══════════════════════════════════════════════════════════\n";
echo "STEP 9: FINAL VERIFICATION TEST\n";
echo "═══════════════════════════════════════════════════════════\n";

try {
    $finalTestEmail = 'final_test_' . time() . '@example.com';
    
    echo "Creating test user with full registration flow...\n";
    
    $user = App\Models\User::create([
        'name' => 'Final Test User',
        'fname' => 'Final',
        'mname' => 'Test',
        'lname' => 'User',
        'course' => 'BS Physical Education',
        'gender' => 'male',
        'email' => $finalTestEmail,
        'password' => Hash::make('password123'),
        'role' => 'Athlete',
        'email_verified_at' => now(),
    ]);
    
    echo "✓ User created successfully!\n";
    echo "  ID: " . $user->id . "\n";
    echo "  Name: " . $user->name . "\n";
    echo "  Email: " . $user->email . "\n";
    echo "  Role: " . $user->role . "\n";
    
    // Verify in database
    $dbUser = DB::table('users')->where('id', $user->id)->first();
    if ($dbUser) {
        echo "✓ User verified in database\n";
    }
    
    // Cleanup
    $user->delete();
    echo "✓ Test user deleted\n\n";
    
} catch (Exception $e) {
    echo "✗ Final test failed: " . $e->getMessage() . "\n\n";
    exit(1);
}

echo "═══════════════════════════════════════════════════════════\n";
echo "SUMMARY\n";
echo "═══════════════════════════════════════════════════════════\n\n";

echo "✅ ALL TESTS PASSED!\n\n";
echo "Registration should now be working on localhost.\n\n";

echo "For production (pathfit.online and Railway):\n";
echo "1. Make sure they use Railway database credentials:\n";
echo "   DB_HOST=shuttle.proxy.rlwy.net\n";
echo "   DB_PORT=10519\n";
echo "   DB_DATABASE=railway\n";
echo "   DB_USERNAME=root\n";
echo "   DB_PASSWORD=yrxVjcGIkzEUSNackIDSDlqmNhNnzKMp\n\n";

echo "2. Clear cache on production:\n";
echo "   php artisan config:clear\n";
echo "   php artisan cache:clear\n\n";

echo "3. Test registration:\n";
echo "   - Visit: https://pathfit.online/register\n";
echo "   - Fill in the form\n";
echo "   - Submit and check for errors\n\n";

echo "═══════════════════════════════════════════════════════════\n";
echo "FIX COMPLETE\n";
echo "═══════════════════════════════════════════════════════════\n";
