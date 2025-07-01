# Use PHP 8.2 with Apache
FROM php:8.2-apache

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git curl zip unzip libpq-dev libonig-dev nodejs npm \
    && docker-php-ext-install pdo pdo_pgsql

# Enable Apache rewrite module
RUN a2enmod rewrite

# Set working directory
WORKDIR /var/www/html

# Copy Composer from official image
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy project files
COPY . .

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Install Node.js dependencies and build Vite assets
RUN npm install && npm run build

# Set Apache DocumentRoot to public
RUN sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-available/000-default.conf

# Laravel config/cache optimization
RUN php artisan config:clear \
    && php artisan config:cache \
    && php artisan route:cache \
    && php artisan view:cache

# Expose port
EXPOSE 80

# Fix permissions and run Apache
CMD mkdir -p storage/framework/{sessions,views,cache} bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache \
    && chown -R www-data:www-data storage bootstrap/cache \
    && php artisan migrate --force \
    && apache2-foreground
