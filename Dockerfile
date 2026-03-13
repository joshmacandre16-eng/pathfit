# ============================================
# Stage 1: Install PHP dependencies
# ============================================
FROM composer:2.7.1 AS composer

ENV COMPOSER_ALLOW_SUPERUSER=1 \
    COMPOSER_NO_INTERACTION=1

WORKDIR /app

# Create non-root user
RUN useradd -m -u 1000 appuser

COPY --chown=appuser:appuser composer.json composer.lock ./

USER appuser
RUN composer install --no-dev --optimize-autoloader --no-interaction

# ============================================
# Stage 2: Build Node dependencies
# ============================================
FROM node:20.14.0-alpine AS node

WORKDIR /app

COPY package.json package-lock.json ./
RUN npm ci --omit=dev

# ============================================
# Stage 3: Production image
# ============================================
FROM php:8.2-apache-bookworm AS production

ENV COMPOSER_ALLOW_SUPERUSER=1 \
    COMPOSER_NO_INTERACTION=1 \
    COMPOSER_MEMORY_LIMIT=-1 \
    APP_ENV=production \
    APP_DEBUG=false \
    LOG_CHANNEL=stderr \
    NODE_ENV=production \
    PORT=8080

# Install system dependencies
RUN apt-get update && apt-get install -y \
    libzip-dev \
    zip \
    unzip \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    curl \
    git \
    && rm -rf /var/lib/apt/lists/* \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo pdo_mysql zip gd

# Enable Apache modules
RUN a2enmod rewrite headers

# Configure Apache document root
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public

RUN sed -ri -e 's|/var/www/html|${APACHE_DOCUMENT_ROOT}|g' \
    /etc/apache2/sites-available/000-default.conf && \
    sed -ri -e 's|/var/www/html|${APACHE_DOCUMENT_ROOT}|g' \
    /etc/apache2/apache2.conf

WORKDIR /var/www/html

# Copy application
COPY --chown=www-data:www-data . .

# Copy vendor dependencies
COPY --from=composer --chown=www-data:www-data /app/vendor ./vendor

# Copy node_modules
COPY --from=node /app/node_modules ./node_modules

# Copy composer binary
COPY --from=composer:2.7.1 /usr/bin/composer /usr/bin/composer

# Set permissions
RUN mkdir -p storage/framework/{cache,sessions,views} \
    storage/logs \
    bootstrap/cache \
    && chown -R www-data:www-data /var/www/html \
    && chmod -R 775 storage bootstrap/cache

# Run Laravel optimizations
USER www-data
RUN composer dump-autoload --optimize --no-dev && \
    php artisan package:discover --ansi || true
USER root

# Healthcheck
RUN echo '#!/bin/bash' > /usr/local/bin/healthcheck \
    && echo 'curl -f http://localhost:8080/ || exit 1' >> /usr/local/bin/healthcheck \
    && chmod +x /usr/local/bin/healthcheck

EXPOSE 8080

HEALTHCHECK --interval=30s --timeout=10s --start-period=5s --retries=3 \
    CMD /usr/local/bin/healthcheck

CMD ["apache2-foreground"]