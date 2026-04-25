#!/bin/bash
set -e

if [ -z "$PORT" ]; then
    PORT=8000
fi

PORT=$((PORT + 0))

php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan migrate --force

php artisan serve --host=0.0.0.0 --port=$PORT