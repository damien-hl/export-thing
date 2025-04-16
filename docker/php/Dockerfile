FROM php:8.4-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
zip unzip libzip-dev libpq-dev libicu-dev libonig-dev libpng-dev zlib1g-dev

# Install PHP extensions
RUN docker-php-ext-install zip intl pdo pdo_pgsql mbstring gd

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/export-thing
