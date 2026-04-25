#!/bin/bash
set -e

PORT=${PORT:-8000}

php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan migrate --force

exec php artisan serve --host=0.0.0.0 --port=$PORT