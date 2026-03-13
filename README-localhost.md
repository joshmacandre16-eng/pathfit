# Running PathFit on Localhost (XAMPP)

## Option 1: XAMPP Apache (Recommended)

1. Double-click `start-xampp.bat` (created by BLACKBOXAI)
2. In XAMPP Control Panel, Start **Apache** and **MySQL**
3. Open browser: **http://localhost/pathfit/public**

## Option 2: Artisan Serve

1. Double-click `serve.bat` (created by joshua)
2. Opens on **http://localhost:8000**

## Database Setup

```
c:/xampp2/php/php.exe artisan migrate
c:/xampp2/php/php.exe artisan db:seed
```

## Notes

- APP_URL in config/app.php is already `http://localhost`
- Ensure no port conflicts (Apache default 80)
- Edit .env for DB credentials if needed (xampp default: root/no password)
