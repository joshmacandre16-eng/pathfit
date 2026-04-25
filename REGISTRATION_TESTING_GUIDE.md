# Registration Testing & Troubleshooting Guide

## Overview
Both URLs point to the same GitHub repository:
- https://pathfit.online/register
- https://pathfit-production.up.railway.app/register

## Quick Test Steps

### 1. Run the Debug Script (Localhost)
```bash
cd c:\xampp2\htdocs\pathfit
php test-registration-debug.php
```

This will check:
- Laravel bootstrap
- Database connection
- Users table structure
- Environment configuration
- User creation capability
- Routes
- File permissions

### 2. Test Registration Manually

#### On Localhost (http://localhost:8000/register)
1. Start your local server:
   ```bash
   php artisan serve
   ```

2. Visit: http://localhost:8000/register

3. Fill in the form:
   - First Name: John
   - Middle Name: (optional)
   - Last Name: Doe
   - Course: BS Physical Education
   - Gender: Male
   - Email: test@example.com
   - Password: password123
   - Confirm Password: password123

4. Click "Create Account"

#### On Production (https://pathfit.online/register)
1. Visit: https://pathfit.online/register
2. Fill in the same test data
3. Click "Create Account"

#### On Railway (https://pathfit-production.up.railway.app/register)
1. Visit: https://pathfit-production.up.railway.app/register
2. Fill in the same test data
3. Click "Create Account"

## Common Issues & Solutions

### Issue 1: "Registration failed. Please try again later."
**Cause:** Database connection issue or missing columns

**Solution:**
1. Check database connection in `.env`
2. Run migrations:
   ```bash
   php artisan migrate
   ```

### Issue 2: "The email has already been taken."
**Cause:** Email already exists in database

**Solution:**
1. Use a different email address
2. Or delete the existing user:
   ```bash
   php artisan tinker
   User::where('email', 'test@example.com')->delete();
   ```

### Issue 3: Page shows 500 error
**Cause:** Missing APP_KEY or database configuration

**Solution:**
1. Generate APP_KEY:
   ```bash
   php artisan key:generate
   ```

2. Check `.env` file has correct database credentials

### Issue 4: Form validation errors
**Cause:** Missing required fields or invalid data

**Solution:**
- Ensure all required fields are filled:
  - First Name (required)
  - Last Name (required)
  - Course (required)
  - Gender (required)
  - Email (required, must be valid email)
  - Password (required, min 8 characters)
  - Confirm Password (must match password)

### Issue 5: Production/Railway registration not working
**Cause:** Environment configuration or database not set up

**Solution:**

#### For Railway:
1. Check environment variables in Railway dashboard:
   - APP_KEY (must be set)
   - DB_CONNECTION=mysql
   - DB_HOST (Railway MySQL host)
   - DB_PORT=3306
   - DB_DATABASE (your database name)
   - DB_USERNAME (your database user)
   - DB_PASSWORD (your database password)

2. Run migrations on Railway:
   ```bash
   # SSH into Railway or use Railway CLI
   php artisan migrate --force
   ```

3. Check logs:
   ```bash
   # In Railway dashboard, check deployment logs
   # Or check Laravel logs
   tail -f storage/logs/laravel.log
   ```

## Database Requirements

The `users` table must have these columns:
- id (primary key)
- name (string)
- fname (string, nullable)
- mname (string, nullable)
- lname (string, nullable)
- course (string, nullable)
- gender (string, nullable)
- email (string, unique)
- password (string)
- role (string, default: 'Athlete')
- email_verified_at (timestamp, nullable)
- remember_token (string, nullable)
- created_at (timestamp)
- updated_at (timestamp)

## Verify Database Structure

Run this SQL query to check your users table:
```sql
DESCRIBE users;
```

Or in Laravel:
```bash
php artisan tinker
Schema::getColumnListing('users');
```

## Test Registration via API (Alternative)

You can also test registration using curl:

```bash
curl -X POST https://pathfit.online/register \
  -H "Content-Type: application/x-www-form-urlencoded" \
  -d "fname=John" \
  -d "mname=Middle" \
  -d "lname=Doe" \
  -d "course=BS Physical Education" \
  -d "gender=male" \
  -d "email=test@example.com" \
  -d "password=password123" \
  -d "password_confirmation=password123" \
  -d "_token=YOUR_CSRF_TOKEN"
```

## Checking Logs

### Localhost:
```bash
tail -f storage/logs/laravel.log
```

### Railway:
Check the deployment logs in Railway dashboard

## Next Steps After Successful Registration

1. User should be redirected to login page with success message
2. Login with the registered credentials
3. Should be redirected to dashboard

## Contact Information

If issues persist:
1. Check the error message displayed on the registration page
2. Check Laravel logs: `storage/logs/laravel.log`
3. Check web server error logs
4. Verify database connection and structure

## Quick Fixes Checklist

- [ ] Database connection working
- [ ] Users table exists with all required columns
- [ ] APP_KEY is set in .env
- [ ] Migrations have been run
- [ ] Storage directories are writable
- [ ] CSRF token is being generated
- [ ] Email is unique (not already registered)
- [ ] Password meets minimum requirements (8 characters)
- [ ] Password confirmation matches password
