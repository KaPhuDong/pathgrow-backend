FROM php:8.2-fpm

# Cài đặt các thư viện hệ thống cần thiết
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip

# Cài đặt PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Cài đặt Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy code vào container
WORKDIR /var/www
COPY . .

# Cài đặt dependencies
RUN composer install --no-dev --optimize-autoloader

# Phân quyền cho Laravel
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

# Cổng mặc định
EXPOSE 80

# Lệnh khởi chạy (sử dụng built-in server của PHP cho đơn giản)
CMD php artisan serve --host=0.0.0.0 --port=80