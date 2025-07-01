FROM php:8.2-apache

RUN apt-get update && apt-get install -y \
    git curl zip unzip libpq-dev libonig-dev \
    && docker-php-ext-install pdo pdo_pgsql

RUN a2enmod rewrite

WORKDIR /var/www/html

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
COPY . .

RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html/storage \
    && chmod -R 755 /var/www/html/bootstrap/cache

RUN composer install --no-interaction --prefer-dist --optimize-autoloader

RUN php artisan config:clear \
 && php artisan route:clear \
 && php artisan view:clear \
 && php artisan cache:clear \
 && php artisan config:cache \
 && php artisan route:cache \
 && php artisan view:cache || true

RUN sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-available/000-default.conf

EXPOSE 80

# ✅ NEW - NO MIGRATE YET, JUST START APACHE
CMD ["apache2-foreground"]

