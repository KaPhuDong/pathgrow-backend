# Base PHP image
FROM php:8.2-cli

# Cài các thư viện cần thiết cho Laravel
RUN apt-get update && apt-get install -y \
    unzip zip git curl libpng-dev libonig-dev libxml2-dev libpq-dev \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Cài Composer từ official image
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Tạo thư mục làm việc
WORKDIR /app

# Copy file composer trước để cache dependencies
COPY composer.json composer.lock ./

# Cài dependencies Laravel (không dev)
RUN composer install --no-dev --optimize-autoloader

# Copy toàn bộ source vào container
COPY . .

# Phân quyền cho storage và bootstrap/cache
RUN chmod -R 777 storage bootstrap/cache

# Laravel sẽ chạy trên $PORT do Render cung cấp
ENV PORT=10000

# Expose port
EXPOSE 10000

# Start Laravel bằng PHP built-in server
CMD php artisan serve --host 0.0.0.0 --port $PORT
