FROM php:8.2-apache

# Enable required extensions
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    curl \
    libpq-dev \
    libzip-dev \
    zip \
    && docker-php-ext-install pdo pdo_pgsql zip

# Set working directory
WORKDIR /var/www/html

# Copy source code
COPY . .

# Set correct Apache doc root
RUN sed -i 's|DocumentRoot /var/www/html|DocumentRoot /var/www/html/public|' /etc/apache2/sites-available/000-default.conf

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set permissions
RUN chmod -R 755 storage bootstrap/cache

# Install dependencies
RUN composer install --no-dev --optimize-autoloader

# Run Laravel setup tasks (cache config, migrate, etc)
RUN php artisan config:clear && \
    php artisan config:cache && \
    php artisan migrate --force || true

# Start Apache
CMD ["apache2-foreground"]
