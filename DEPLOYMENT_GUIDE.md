# PathFit Database Auto-Setup Guide

## 🎯 Overview
This guide provides **3 methods** to automatically set up your database with migrations and seed data.

---

## ✅ Method 1: One-Click Batch File (RECOMMENDED)

### Steps:
1. **Double-click** `auto-setup.bat` in the project root
2. Wait for completion message
3. Done!

### What it does:
- ✓ Checks database connection
- ✓ Creates missing tables (users, activity_reports)
- ✓ Seeds users (1 admin, 3 coaches, 6 athletes)
- ✓ Seeds activity reports (10 sample records)
- ✓ Skips if data already exists

---

## ✅ Method 2: Automatic on Page Load (ENABLED)

### How it works:
The middleware `AutoSetupDatabase` runs automatically when you visit any page.

### Steps:
1. Start your server: `php artisan serve`
2. Visit: http://localhost:8000
3. Setup runs automatically in background
4. Cached for 24 hours to avoid repeated checks

### To disable:
Remove these lines from `bootstrap/app.php`:
```php
$middleware->web(append: [
    \App\Http\Middleware\AutoSetupDatabase::class,
]);
```

---

## ✅ Method 3: Manual SQL Script (phpMyAdmin)

### Steps:
1. Open phpMyAdmin: http://localhost/phpmyadmin
2. Select `pathfit` database
3. Click **Import** tab
4. Choose file: `database-setup.sql`
5. Click **Go**

### Alternative (Command Line):
```bash
mysql -u root -p pathfit < database-setup.sql
```

---

## 🔍 Verification

### Check via Command Line:
```bash
php artisan tinker
>>> \App\Models\User::count()
>>> \App\Models\ActivityReport::count()
```

### Check via SQL:
```sql
SELECT COUNT(*) FROM users;
SELECT COUNT(*) FROM activity_reports;
```

### Expected Results:
- **Users:** 10 records (1 admin, 3 coaches, 6 athletes)
- **Activity Reports:** 10 records

---

## 👥 Default User Credentials

| Role | Email | Password |
|------|-------|----------|
| Admin | admin@pathfit.com | password123 |
| Coach | coach.johnson@pathfit.com | password123 |
| Coach | coach.williams@pathfit.com | password123 |
| Coach | coach.martinez@pathfit.com | password123 |
| Athlete | john.smith@pathfit.com | password123 |
| Athlete | emma.davis@pathfit.com | password123 |
| Athlete | alex.brown@pathfit.com | password123 |
| Athlete | lisa.wilson@pathfit.com | password123 |
| Athlete | david.garcia@pathfit.com | password123 |
| Athlete | sophie.anderson@pathfit.com | password123 |

---

## 🔄 Reset Database

### Full Reset:
```bash
php artisan migrate:fresh --seed
```

### Reset Specific Table:
```bash
php artisan migrate:refresh --path=/database/migrations/2026_01_11_045247_create_activity_reports_table.php
php artisan db:seed --class=ActivityReportSeeder
```

---

## 🛠️ Troubleshooting

### Error: "Database connection failed"
**Solution:** Check `.env` file:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=pathfit
DB_USERNAME=root
DB_PASSWORD=
```

### Error: "Table already exists"
**Solution:** This is normal. The script skips existing tables.

### Error: "Foreign key constraint fails"
**Solution:** Run migrations in order:
```bash
php artisan migrate:fresh
php artisan db:seed
```

### Clear setup cache:
```bash
php artisan cache:clear
```

---

## 📋 Files Created

| File | Purpose |
|------|---------|
| `auto-setup.php` | CLI script for setup |
| `auto-setup.bat` | Windows batch file |
| `database-setup.sql` | Raw SQL script |
| `app/Http/Middleware/AutoSetupDatabase.php` | Auto-run middleware |
| `DEPLOYMENT_GUIDE.md` | This file |

---

## 🚀 Production Deployment

### Railway/Heroku:
Add to your deployment script:
```bash
php artisan migrate --force
php artisan db:seed --force
```

### Docker:
Add to `Dockerfile`:
```dockerfile
RUN php artisan migrate --force && php artisan db:seed --force
```

---

## ⚠️ Important Notes

1. **Duplicate Prevention:** All methods check for existing data before inserting
2. **Password Hash:** All users use bcrypt hash of "password123"
3. **Foreign Keys:** Activity reports reference user IDs (4-8 are athletes)
4. **MySQL Version:** Compatible with MySQL 5.7+
5. **Rollback:** Use `php artisan migrate:rollback` to undo migrations

---

## 📞 Support

If you encounter issues:
1. Check Laravel logs: `storage/logs/laravel.log`
2. Verify database connection: `php artisan tinker` → `DB::connection()->getPdo()`
3. Run: `php artisan config:clear && php artisan cache:clear`
