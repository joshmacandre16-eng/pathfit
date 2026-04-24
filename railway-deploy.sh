#!/bin/bash
# Railway deployment script
php artisan config:clear
php artisan cache:clear
php artisan migrate --force
php artisan db:seed --force