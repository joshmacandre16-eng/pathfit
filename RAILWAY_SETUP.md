# Railway Deployment Setup

## Environment Variables to Add in Railway Dashboard

Go to Railway Dashboard → Your Laravel Service → Variables tab and add:

```
APP_NAME="Pathfit"
APP_ENV="production"
APP_KEY="base64:104BldsCoLGu57MChna4P9bDLv8yufCG0Bdb+6k5/wI="
APP_DEBUG="false"
APP_URL="https://pathfit.online"
DB_CONNECTION="mysql"
DB_HOST=${{MySQL.MYSQLHOST}}
DB_PORT=${{MySQL.MYSQLPORT}}
DB_DATABASE=${{MySQL.MYSQLDATABASE}}
DB_USERNAME=${{MySQL.MYSQLUSER}}
DB_PASSWORD=${{MySQL.MYSQL_ROOT_PASSWORD}}
```

## Deploy Commands

```bash
git add .
git commit -m "Add automatic database migration on deploy"
git push
```

Railway will automatically run migrations on each deployment.