#!/bin/bash

# Ensure PORT is set and is numeric
if [ -z "$PORT" ]; then
    PORT=8000
fi

# Cast PORT to integer by doing arithmetic operation
PORT=$((PORT + 0))

# Start the Laravel application
php artisan serve --host=0.0.0.0 --port=$PORT