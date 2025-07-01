# Use official PHP image with Apache
FROM php:8.2-apache

# Install system dependencies for PostgreSQL and Laravel
RUN apt-get update && apt-get install -y \
    git curl zip unzip libpq-dev libonig-dev \
    && docker-php-ext-install pdo pdo_pgsql

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Set working directory to Laravel root (not public!)
WORKDIR /var/www/html

# Copy project files
COPY . .

# Set proper permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html/storage \
    && chmod -R 755 /var/www/html/bootstrap/cache

# Copy Composer from official image
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Install PHP dependencies
RUN composer install --no-interaction --prefer-dist --optimize-autoloader

# Clear and cache Laravel config
RUN php artisan config:clear && php artisan config:cache

# Set Apache to serve from Laravel public directory
RUN sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-available/000-default.conf

# Expose port 80
EXPOSE 80

# Start Apache
CMD ["apache2-foreground"]
