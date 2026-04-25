#!/bin/bash
set -e

PORT=${PORT:-8000}

echo "Starting application on port $PORT"

php artisan migrate --force || echo "Migration failed, continuing..."

exec php artisan serve --host=0.0.0.0 --port=$PORT