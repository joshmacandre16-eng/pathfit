# Configure pathfit.online to Use Railway Database

## ✅ Your Railway Database Credentials

```
Connection String: mysql://root:yrxVjcGIkzEUSNackIDSDlqmNhNnzKMp@shuttle.proxy.rlwy.net:10519/railway

Breakdown:
- DB_HOST: shuttle.proxy.rlwy.net
- DB_PORT: 10519
- DB_DATABASE: railway
- DB_USERNAME: root
- DB_PASSWORD: yrxVjcGIkzEUSNackIDSDlqmNhNnzKMp
```

## 🎯 What You Need to Do

You need to set these environment variables on your **pathfit.online hosting**.

## 📋 Step-by-Step Instructions

### Step 1: Identify Your pathfit.online Hosting Type

First, determine where pathfit.online is hosted:
- [ ] Cloudflare Pages
- [ ] Vercel
- [ ] Netlify
- [ ] cPanel/Shared Hosting
- [ ] VPS/Dedicated Server
- [ ] Other: __________

### Step 2: Set Environment Variables

Choose the method based on your hosting:

---

#### Option A: If using Cloudflare Pages

1. Go to https://dash.cloudflare.com
2. Select your pathfit.online project
3. Go to **Settings** → **Environment Variables**
4. Add these variables:

```
DB_CONNECTION = mysql
DB_HOST = shuttle.proxy.rlwy.net
DB_PORT = 10519
DB_DATABASE = railway
DB_USERNAME = root
DB_PASSWORD = yrxVjcGIkzEUSNackIDSDlqmNhNnzKMp
SESSION_DRIVER = database
CACHE_STORE = database
```

5. **Redeploy** your application

---

#### Option B: If using Vercel

1. Go to https://vercel.com/dashboard
2. Select your pathfit project
3. Go to **Settings** → **Environment Variables**
4. Add these variables:

```
DB_CONNECTION = mysql
DB_HOST = shuttle.proxy.rlwy.net
DB_PORT = 10519
DB_DATABASE = railway
DB_USERNAME = root
DB_PASSWORD = yrxVjcGIkzEUSNackIDSDlqmNhNnzKMp
SESSION_DRIVER = database
CACHE_STORE = database
```

5. **Redeploy** your application

---

#### Option C: If using cPanel/Shared Hosting

1. Login to your cPanel
2. Find **File Manager**
3. Navigate to your pathfit.online directory (usually `public_html` or `pathfit.online`)
4. Find the `.env` file (enable "Show Hidden Files" if needed)
5. Edit `.env` file and update these lines:

```env
DB_CONNECTION=mysql
DB_HOST=shuttle.proxy.rlwy.net
DB_PORT=10519
DB_DATABASE=railway
DB_USERNAME=root
DB_PASSWORD=yrxVjcGIkzEUSNackIDSDlqmNhNnzKMp
SESSION_DRIVER=database
CACHE_STORE=database
```

6. Save the file
7. Clear cache (see Step 3 below)

---

#### Option D: If using VPS/Dedicated Server (SSH Access)

1. SSH into your server:
   ```bash
   ssh user@pathfit.online
   ```

2. Navigate to your application directory:
   ```bash
   cd /var/www/pathfit.online
   # or wherever your app is located
   ```

3. Edit the .env file:
   ```bash
   nano .env
   ```

4. Update these lines:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=shuttle.proxy.rlwy.net
   DB_PORT=10519
   DB_DATABASE=railway
   DB_USERNAME=root
   DB_PASSWORD=yrxVjcGIkzEUSNackIDSDlqmNhNnzKMp
   SESSION_DRIVER=database
   CACHE_STORE=database
   ```

5. Save and exit (Ctrl+X, then Y, then Enter)

6. Clear cache (see Step 3 below)

---

### Step 3: Clear Laravel Cache

After updating environment variables, you MUST clear the cache:

#### If you have SSH access:
```bash
cd /path/to/your/app
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear
```

#### If you DON'T have SSH access:
Create a file called `clear-cache.php` in your `public` folder:

```php
<?php
// public/clear-cache.php
require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

Artisan::call('config:clear');
Artisan::call('cache:clear');
Artisan::call('route:clear');
Artisan::call('view:clear');

echo "Cache cleared successfully!";
?>
```

Then visit: `https://pathfit.online/clear-cache.php`

**IMPORTANT:** Delete this file after use for security!

---

### Step 4: Test the Connection

Create a test file: `public/test-db.php`

```php
<?php
require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "<h1>Database Connection Test</h1>";
echo "<p><strong>DB Host:</strong> " . config('database.connections.mysql.host') . "</p>";
echo "<p><strong>DB Port:</strong> " . config('database.connections.mysql.port') . "</p>";
echo "<p><strong>DB Database:</strong> " . config('database.connections.mysql.database') . "</p>";
echo "<p><strong>DB Username:</strong> " . config('database.connections.mysql.username') . "</p>";

try {
    DB::connection()->getPdo();
    echo "<p style='color:green; font-size:20px;'><strong>✓ Database Connected Successfully!</strong></p>";
    
    $userCount = DB::table('users')->count();
    echo "<p><strong>Total Users in Database:</strong> $userCount</p>";
    
    echo "<p style='color:green;'>Both domains are now using the SAME Railway database!</p>";
} catch (Exception $e) {
    echo "<p style='color:red; font-size:20px;'><strong>✗ Connection Failed!</strong></p>";
    echo "<p style='color:red;'><strong>Error:</strong> " . $e->getMessage() . "</p>";
}
?>
```

Visit: `https://pathfit.online/test-db.php`

**Expected Result:**
- ✓ Database Connected Successfully!
- Total Users: [same number as Railway]

**IMPORTANT:** Delete this file after testing for security!

---

### Step 5: Test Registration

1. Visit: https://pathfit.online/register
2. Fill in the registration form:
   - First Name: Test
   - Last Name: User
   - Course: BS PE
   - Gender: Male
   - Email: test123@example.com
   - Password: password123
   - Confirm Password: password123
3. Click "Create Account"
4. Should redirect to login with success message
5. Check Railway database - the new user should be there!

---

## 🔍 Verification Checklist

After completing the steps above:

- [ ] Environment variables updated on pathfit.online
- [ ] Cache cleared
- [ ] test-db.php shows "Database Connected Successfully"
- [ ] User count matches between both domains
- [ ] Registration on pathfit.online works
- [ ] New user appears in Railway database
- [ ] Can login with newly registered account

---

## 🚨 Troubleshooting

### Issue: "Connection Failed" error

**Solution:**
1. Double-check the database credentials (no extra spaces)
2. Ensure your hosting allows external MySQL connections
3. Check if Railway database allows connections from your IP

### Issue: "SQLSTATE[HY000] [2002] Connection timed out"

**Solution:**
Your hosting might be blocking external database connections. Contact your hosting support to:
1. Whitelist Railway's IP: `shuttle.proxy.rlwy.net`
2. Allow outbound connections on port 10519

### Issue: Cache not clearing

**Solution:**
1. Manually delete files in `storage/framework/cache/`
2. Manually delete files in `bootstrap/cache/`
3. Restart your web server

---

## 🎉 Success!

Once configured correctly:
- ✅ https://pathfit.online/register → Stores data in Railway DB
- ✅ https://pathfit-production.up.railway.app/register → Stores data in Railway DB
- ✅ Both domains share the SAME database
- ✅ Users can register on either domain and login on both!

---

## 📞 Need Help?

If you're stuck, tell me:
1. What type of hosting is pathfit.online using?
2. Do you have SSH access?
3. What error message do you see when testing?
