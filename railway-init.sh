#!/bin/bash
set -e

echo "Starting deployment..."

echo "Clearing caches..."
php artisan optimize:clear || true

echo "Running database migrations..."
php artisan migrate --force || echo "Migration failed, continuing..."

echo "Seeding database..."
php artisan db:seed --force || echo "Seeding failed, continuing..."

echo "Caching configurations..."
php artisan config:cache || true
php artisan route:cache || true
php artisan view:cache || true

echo "Deployment completed!"