<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use App\Models\User;

Route::get('/railway-health-check', function () {
    $checks = [];
    
    // 1. Database Connection
    try {
        DB::connection()->getPdo();
        $checks['database_connection'] = [
            'status' => 'OK',
            'connection' => config('database.default'),
            'host' => config('database.connections.mysql.host'),
            'database' => config('database.connections.mysql.database'),
        ];
    } catch (\Exception $e) {
        $checks['database_connection'] = [
            'status' => 'FAILED',
            'error' => $e->getMessage()
        ];
    }
    
    // 2. Users Table
    try {
        if (Schema::hasTable('users')) {
            $userCount = DB::table('users')->count();
            $checks['users_table'] = [
                'status' => 'OK',
                'exists' => true,
                'user_count' => $userCount
            ];
        } else {
            $checks['users_table'] = [
                'status' => 'FAILED',
                'exists' => false
            ];
        }
    } catch (\Exception $e) {
        $checks['users_table'] = [
            'status' => 'FAILED',
            'error' => $e->getMessage()
        ];
    }
    
    // 3. Required Columns
    try {
        $columns = Schema::getColumnListing('users');
        $requiredColumns = ['id', 'name', 'fname', 'lname', 'email', 'password', 'role', 'course', 'gender'];
        $missingColumns = array_diff($requiredColumns, $columns);
        
        $checks['table_structure'] = [
            'status' => empty($missingColumns) ? 'OK' : 'FAILED',
            'required_columns' => $requiredColumns,
            'missing_columns' => $missingColumns
        ];
    } catch (\Exception $e) {
        $checks['table_structure'] = [
            'status' => 'FAILED',
            'error' => $e->getMessage()
        ];
    }
    
    // 4. Registration Test (Dry Run)
    try {
        $testEmail = 'health_check_' . time() . '@test.railway';
        
        $user = User::create([
            'name' => 'Health Check User',
            'fname' => 'Health',
            'mname' => 'Check',
            'lname' => 'User',
            'course' => 'Test Course',
            'gender' => 'male',
            'email' => $testEmail,
            'password' => bcrypt('testpassword123'),
            'role' => 'Athlete',
        ]);
        
        // Verify and cleanup
        $savedUser = User::where('email', $testEmail)->first();
        if ($savedUser) {
            $passwordHashed = strlen($savedUser->password) === 60;
            $savedUser->delete();
            
            $checks['registration_test'] = [
                'status' => 'OK',
                'user_created' => true,
                'password_hashed' => $passwordHashed,
                'test_user_cleaned' => true
            ];
        } else {
            $checks['registration_test'] = [
                'status' => 'FAILED',
                'user_created' => false
            ];
        }
    } catch (\Exception $e) {
        $checks['registration_test'] = [
            'status' => 'FAILED',
            'error' => $e->getMessage()
        ];
    }
    
    // Overall Status
    $allOk = true;
    foreach ($checks as $check) {
        if ($check['status'] !== 'OK') {
            $allOk = false;
            break;
        }
    }
    
    return response()->json([
        'overall_status' => $allOk ? 'HEALTHY' : 'UNHEALTHY',
        'timestamp' => now()->toDateTimeString(),
        'environment' => config('app.env'),
        'checks' => $checks
    ], $allOk ? 200 : 500);
});
