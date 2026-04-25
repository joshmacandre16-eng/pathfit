#!/bin/bash
set -e

PORT=${PORT:-8000}

echo "Starting on port $PORT"
echo "DB_CONNECTION: ${DB_CONNECTION:-not set}"
echo "DB_HOST: ${DB_HOST:-not set}"

if [ -z "$APP_KEY" ]; then
    echo "ERROR: APP_KEY not set"
    php artisan key:generate --force
fi

php artisan migrate --force 2>&1 || echo "Migration skipped"

echo "Starting server..."
exec php artisan serve --host=0.0.0.0 --port=$PORT --no-reload