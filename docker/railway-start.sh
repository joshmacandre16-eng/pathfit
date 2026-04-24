#!/bin/sh
set -e

# Railway injects $PORT. Default to 80 for local Docker.
export PORT="${PORT:-80}"

# Update nginx to listen on the Railway-provided port
sed -i "s/listen 80;/listen ${PORT};/" /etc/nginx/http.d/default.conf

# Laravel runtime optimizations (must run at startup, not build time)
php artisan config:cache || true
php artisan route:cache || true
php artisan view:cache || true

# Ensure storage and cache directories are writable
chmod -R 755 /app/storage /app/bootstrap/cache 2>/dev/null || true
chown -R www-data:www-data /app/storage /app/bootstrap/cache 2>/dev/null || true

# Start Supervisor (nginx + php-fpm)
exec /usr/bin/supervisord -c /etc/supervisor/conf.d/supervisord.conf

