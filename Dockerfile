FROM php:8.2-cli

# Install system dependencies
RUN apt-get update && apt-get install -y \
    unzip git curl libzip-dev \
    && docker-php-ext-install zip pdo pdo_mysql

# Install composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /app

COPY . .

RUN composer install --no-dev --optimize-autoloader

CMD php artisan serve --host=0.0.0.0 --port=$PORT
