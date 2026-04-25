@echo off
echo ========================================
echo PathFit Database Verification
echo ========================================
echo.

cd /d "%~dp0"

php -r "require 'vendor/autoload.php'; $app = require 'bootstrap/app.php'; $kernel = $app->make(Illuminate\Contracts\Console\Kernel::class); $kernel->bootstrap(); use Illuminate\Support\Facades\DB; use Illuminate\Support\Facades\Schema; try { DB::connection()->getPdo(); echo 'Database: Connected\n'; echo 'Users: ' . DB::table('users')->count() . ' records\n'; echo 'Activity Reports: ' . DB::table('activity_reports')->count() . ' records\n'; echo '\nUser Breakdown:\n'; $roles = DB::table('users')->select('role', DB::raw('count(*) as count'))->groupBy('role')->get(); foreach($roles as $role) { echo '  ' . $role->role . ': ' . $role->count . '\n'; } echo '\nSample Users:\n'; $users = DB::table('users')->select('name', 'email', 'role')->limit(5)->get(); foreach($users as $user) { echo '  ' . $user->name . ' (' . $user->role . ') - ' . $user->email . '\n'; } } catch (Exception $e) { echo 'Error: ' . $e->getMessage(); }"

echo.
echo ========================================
echo Default Password: password123
echo ========================================
pause
