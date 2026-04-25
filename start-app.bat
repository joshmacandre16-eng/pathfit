@echo off
echo Starting PathFit Application...
echo.

echo Checking database connection...
php test-connection.php
echo.

echo Starting Laravel development server...
echo Open your browser and go to: http://localhost:8000
echo.
echo Available test accounts:
echo - Admin: admin@pathfit.com / password123
echo - User: john.doe@test.com / password123
echo.
echo Press Ctrl+C to stop the server
echo.

php artisan serve --host=0.0.0.0 --port=8000