# Use official PHP 8.2 image with Apache
FROM php:8.2-apache

# Install system dependencies and PHP extensions
RUN apt-get update && apt-get install -y \
    git curl zip unzip libpq-dev libonig-dev gnupg \
    && docker-php-ext-install pdo pdo_pgsql

# Install Node.js 18.x
RUN curl -fsSL https://deb.nodesource.com/setup_18.x | bash - \
    && apt-get install -y nodejs

# Enable Apache rewrite module
RUN a2enmod rewrite

# Set working directory
WORKDIR /var/www/html

# Copy Composer from official image
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy package.json and package-lock.json first (cache npm install)
COPY package*.json ./

# Install Node dependencies
RUN npm install

# Copy composer.json and composer.lock for caching composer install
COPY composer.json composer.lock ./

# Install PHP dependencies (without dev)
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Copy the rest of the project files
COPY . .

# Run build for Vite assets
RUN npm run build

# Fix Apache root to point to public folder
RUN sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-available/000-default.conf

# Expose port 80
EXPOSE 80

# Runtime commands: fix permissions, cache config, migrate, launch Apache
CMD mkdir -p \
      storage/framework/sessions \
      storage/framework/views \
      storage/framework/cache \
      bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache \
    && chown -R www-data:www-data storage bootstrap/cache \
    && php artisan config:clear \
    && php artisan config:cache \
    && php artisan route:cache \
    && php artisan view:cache \
    && php artisan migrate --force \
    && apache2-foreground
