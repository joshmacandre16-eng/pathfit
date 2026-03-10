# ============================================
# Stage 1: Install PHP dependencies
# ============================================
FROM composer:2.7 AS composer

WORKDIR /app

# Copy composer files first for better caching
COPY composer.json composer.lock ./
RUN composer install --no-dev --no-interaction --optimize-autoloader

# ============================================
# Stage 2: Build NPM assets
# ============================================
FROM node:20-alpine AS node

WORKDIR /app

# Copy package files
COPY package.json package-lock.json ./
RUN npm ci --production

# ============================================
# Stage 3: Production build
# ============================================
FROM php:8.2-apache-bookworm AS production

# Set environment variables
ENV APP_NAME=pathfit \
    APP_ENV=production \
    APP_DEBUG=false \
    LOG_CHANNEL=stderr \
    NODE_ENV=production \
    PORT=8080

# Install system dependencies and PHP extensions
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

# Enable Apache required modules
RUN a2enmod rewrite headers

# Configure Apache
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public

# Copy Apache configuration
RUN sed -ri \
    -e 's|/var/www/html|${APACHE_DOCUMENT_ROOT}|g' \
    /etc/apache2/sites-available/000-default.conf \
    && sed -ri \
    -e 's|/var/www/html|${APACHE_DOCUMENT_ROOT}|g' \
    /etc/apache2/apache2.conf

WORKDIR /var/www/html

# Copy application files
COPY --chown=www-data:www-data . .

# Copy vendor from composer stage
COPY --from=composer --chown=www-data:www-data /app/vendor ./vendor

# Copy node_modules from node stage (for build artifacts)
COPY --from=node /app/node_modules ./node_modules

# Create storage directories
RUN mkdir -p storage/framework/{cache,sessions,views} \
    && mkdir -p storage/logs \
    && chmod -R 775 storage \
    && chmod -R 775 bootstrap/cache \
    && chown -R www-data:www-data /var/www/html

# Generate application key
RUN php artisan key:generate --force

# Build npm assets for production
RUN if [ -f "package.json" ]; then \
    npm run build; \
    fi

# Expose port (Cloud Run provides $PORT)
EXPOSE 8080

# Health check
HEALTHCHECK --interval=30s --timeout=10s --start-period=5s --retries=3 \
    CMD curl -f http://localhost:8080/ || exit 1

# Start Apache
CMD ["apache2-foreground"]

