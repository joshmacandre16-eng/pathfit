FROM node:20-alpine AS node-builder

WORKDIR /app
COPY package*.json ./
RUN npm ci

COPY . .
RUN npm run build

FROM php:8.3-fpm-alpine

WORKDIR /app

# Define PHPIZE_DEPS for easier management
ENV PHPIZE_DEPS="autoconf dpkg-dev dpkg file g++ gcc libc-dev make pkgconf re2c"

# Install build and runtime dependencies
RUN apk add --no-cache \
    libpng \
    libjpeg-turbo \
    freetype \
    oniguruma \
    libpq \
    libzip \
    zip \
    unzip \
    git \
    curl \
    nginx \
    supervisor \
    sqlite \
    && apk add --no-cache --virtual .build-deps \
        $PHPIZE_DEPS \
        libpng-dev \
        libjpeg-turbo-dev \
        freetype-dev \
        oniguruma-dev \
        postgresql-dev \
        libzip-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) \
        gd \
        pdo \
        pdo_mysql \
        pdo_pgsql \
        exif \
        pcntl \
        bcmath \
        mysqli \
        zip \
    && apk del .build-deps \
    && rm -rf /var/cache/apk/*

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Install PHP dependencies (without scripts/autoloader since artisan is not yet present)
COPY composer.* ./
RUN composer install --no-dev --no-scripts --no-autoloader --no-interaction --no-progress

# Copy application code and built assets
COPY . .
COPY --from=node-builder /app/public/build ./public/build

# Generate optimized autoloader and run Laravel package discovery now that artisan exists
RUN composer dump-autoload --optimize

# Set permissions
RUN chown -R www-data:www-data /app \
    && chmod -R 755 /app/storage \
    && chmod -R 755 /app/bootstrap/cache

# Copy runtime configurations
COPY docker/nginx.conf /etc/nginx/http.d/default.conf
COPY docker/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

EXPOSE 80

CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]
