# Fix pathfit.online Database Connection

## Problem
- https://pathfit-production.up.railway.app/register ✅ WORKS (stores data)
- https://pathfit.online/register ❌ DOESN'T WORK (doesn't store data)

Both use the same GitHub repo but different databases!

## Root Cause
Each domain has its own environment variables (.env file). 
The pathfit.online domain is NOT connected to the Railway database.

## Solution: Connect pathfit.online to Railway Database

### Step 1: Get Railway Database Credentials

1. Go to Railway Dashboard: https://railway.app
2. Select your PathFit project
3. Click on your MySQL database service
4. Go to "Variables" or "Connect" tab
5. Copy these values:
   - `MYSQL_HOST` (e.g., containers-us-west-123.railway.app)
   - `MYSQL_PORT` (usually 3306)
   - `MYSQL_DATABASE` (e.g., railway)
   - `MYSQL_USER` (e.g., root)
   - `MYSQL_PASSWORD` (long random string)

### Step 2: Configure pathfit.online Environment

You need to set these environment variables on pathfit.online hosting:

```env
APP_NAME=PathFit
APP_ENV=production
APP_KEY=base64:YOUR_APP_KEY_HERE
APP_DEBUG=false
APP_URL=https://pathfit.online

# IMPORTANT: Use Railway database credentials
DB_CONNECTION=mysql
DB_HOST=containers-us-west-XXX.railway.app
DB_PORT=3306
DB_DATABASE=railway
DB_USERNAME=root
DB_PASSWORD=YOUR_RAILWAY_DB_PASSWORD

SESSION_DRIVER=database
SESSION_LIFETIME=120
CACHE_STORE=database
QUEUE_CONNECTION=database

LOG_CHANNEL=stack
LOG_LEVEL=error
```

### Step 3: How to Set Environment Variables (depends on your hosting)

#### Option A: If using cPanel/Plesk
1. Login to your hosting control panel
2. Find "Environment Variables" or "PHP Settings"
3. Add each variable above

#### Option B: If using .env file on server
1. SSH into your pathfit.online server
2. Navigate to your application directory
3. Edit the .env file:
   ```bash
   nano .env
   ```
4. Update the database credentials to match Railway
5. Save and exit

#### Option C: If using Cloudflare Pages/Vercel/Netlify
1. Go to your deployment dashboard
2. Find "Environment Variables" settings
3. Add each variable above

### Step 4: Generate APP_KEY (if missing)

If you don't have an APP_KEY:

```bash
# On your server or locally
php artisan key:generate --show
```

Copy the output and set it as APP_KEY in your environment variables.

### Step 5: Clear Cache

After updating environment variables:

```bash
# SSH into pathfit.online server
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear
```

### Step 6: Test Registration

1. Visit https://pathfit.online/register
2. Fill in the registration form
3. Submit
4. Check if data is stored in Railway database

## Verification Steps

### Check if pathfit.online is connected to Railway database:

1. Create a test file on pathfit.online server: `public/db-check.php`

```php
<?php
require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "<h1>Database Connection Test</h1>";
echo "<p><strong>DB Host:</strong> " . config('database.connections.mysql.host') . "</p>";
echo "<p><strong>DB Database:</strong> " . config('database.connections.mysql.database') . "</p>";
echo "<p><strong>DB Username:</strong> " . config('database.connections.mysql.username') . "</p>";

try {
    DB::connection()->getPdo();
    echo "<p style='color:green;'><strong>✓ Database Connected!</strong></p>";
    
    $userCount = DB::table('users')->count();
    echo "<p><strong>Total Users:</strong> $userCount</p>";
} catch (Exception $e) {
    echo "<p style='color:red;'><strong>✗ Connection Failed:</strong> " . $e->getMessage() . "</p>";
}
?>
```

2. Visit: https://pathfit.online/db-check.php
3. It should show the same user count as Railway

## Alternative Solution: Use Same Deployment

If you can't configure environment variables on pathfit.online, consider:

### Option 1: Point pathfit.online to Railway
1. In your domain registrar (where you bought pathfit.online)
2. Update DNS settings:
   - Add CNAME record: `pathfit.online` → `pathfit-production.up.railway.app`
3. In Railway dashboard:
   - Go to Settings → Domains
   - Add custom domain: `pathfit.online`

This way, both URLs point to the same Railway deployment!

### Option 2: Deploy to pathfit.online hosting
1. Deploy your code to pathfit.online server
2. Configure it to use Railway database (as shown above)

## Quick Diagnostic

Run this on pathfit.online server to see current database config:

```bash
php artisan tinker
config('database.connections.mysql');
exit
```

Compare the output with your Railway database credentials.

## Summary

The issue is NOT with your code - it's with environment configuration!

✅ **Working:** Railway deployment → Railway database
❌ **Not Working:** pathfit.online → Unknown/Different database

**Fix:** Configure pathfit.online to use the same Railway database credentials.
