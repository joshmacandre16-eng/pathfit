# Base image assumption from build logs (PHP 8.3 on Alpine)
FROM php:8.3-fpm-alpine

# Install build dependencies, runtime tools, and PHP extensions
RUN apk add --no-cache \
    $PHPIZE_DEPS \
    libpng-dev \
    libjpeg-turbo-dev \
    freetype-dev \
    oniguruma-dev \
    postgresql-dev \
    libzip-dev \
    libzip \
    zip \
    unzip \
    git \
    curl \
    nginx \
    supervisor \
    sqlite \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd pdo pdo_mysql pdo_pgsql exif pcntl bcmath mysqli zip \
    && apk del \
    $PHPIZE_DEPS \
    libpng-dev \
    libjpeg-turbo-dev \
    freetype-dev \
    oniguruma-dev \
    postgresql-dev \
    libzip-dev \
    && rm -rf /var/cache/apk/*

# Continue with your application setup...

