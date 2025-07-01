#!/bin/bash

# Run Composer install
composer install --no-dev --optimize-autoloader

# Run Laravel tasks
php artisan config:clear
php artisan config:cache
php artisan migrate --force

# Start Apache
apache2-foreground
