#!/bin/bash
set -e

echo "Running database migrations..."
php artisan migrate --force

echo "Caching configurations..."
php artisan optimize:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "Deployment completed successfully!"