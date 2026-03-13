@echo off
echo Starting XAMPP Apache and MySQL for PathFit...
cd /d "c:/xampp2"
call xampp-control.exe
echo.
echo Access your app at: http://localhost/pathfit/public
echo Run migrations: cd /d "c:/xampp2/htdocs/pathfit" && "c:/xampp2/php/php.exe" artisan migrate
pause
