# Use official PHP image with Apache
FROM php:8.2-apache

# Install required packages for Laravel and PostgreSQL
RUN apt-get update && apt-get install -y \
    git curl zip unzip libpq-dev libonig-dev \
    && docker-php-ext-install pdo pdo_pgsql

# Enable Apache rewrite module
RUN a2enmod rewrite

# Set working directory
WORKDIR /var/www/html

# Copy Composer from official image
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy application files
COPY . .

# Set permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 storage bootstrap/cache

# Install PHP dependencies
RUN composer install --no-interaction --prefer-dist --optimize-autoloader

# Set Laravel key (optional if already set in .env)
# RUN php artisan key:generate

# Clear and cache config
RUN php artisan config:clear && php artisan config:cache

# Expose Apache
EXPOSE 80

# Start Apache
CMD ["apache2-foreground"]
