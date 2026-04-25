@echo off
echo Testing API Registration with CURL
echo ===================================
echo.

curl -X POST http://localhost:8000/api/register ^
  -H "Content-Type: application/json" ^
  -H "Accept: application/json" ^
  -d "{\"fname\":\"John\",\"mname\":\"M\",\"lname\":\"Doe\",\"course\":\"Computer Science\",\"gender\":\"male\",\"email\":\"test%random%@example.com\",\"password\":\"password123\",\"password_confirmation\":\"password123\"}"

echo.
echo.
echo ===================================
echo Test Complete
echo ===================================
pause
