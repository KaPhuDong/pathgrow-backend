# Dùng PHP với Apache
FROM php:8.2-apache

# Cài extension cần thiết cho Laravel + MySQL
RUN apt-get update && apt-get install -y \
    git curl unzip libpq-dev libonig-dev libzip-dev libpng-dev libjpeg-dev libfreetype6-dev \
    && docker-php-ext-install pdo pdo_mysql mbstring zip gd

# Enable Apache mod_rewrite (Laravel cần cho routing)
RUN a2enmod rewrite

# Copy code vào container
WORKDIR /var/www/html
COPY . .

# Cài Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer
RUN composer install --no-dev --optimize-autoloader

# Laravel cache config + route + view (có migrate)
RUN php artisan config:cache || true \
    && php artisan route:cache || true \
    && php artisan view:cache || true

# Expose port
EXPOSE 8080

# Start command (chạy migrate trước rồi serve)
CMD php artisan migrate --force && \
    php artisan serve --host 0.0.0.0 --port 8080
