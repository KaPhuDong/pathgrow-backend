FROM php:8.2-cli

# Cài các thư viện cần thiết cho Laravel
RUN apt-get update && apt-get install -y \
    unzip zip git curl libpng-dev libonig-dev libxml2-dev \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Cài Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Tạo thư mục app
WORKDIR /app

# Copy file cấu hình trước (tối ưu cache)
COPY composer.json composer.lock ./

# Cài dependency Laravel
RUN composer install --no-dev --optimize-autoloader

# Copy toàn bộ source
COPY . .

# Phân quyền cho storage và cache
RUN chmod -R 777 storage bootstrap/cache

# Render yêu cầu app chạy trên $PORT
ENV PORT=10000

# Expose port cho Render
EXPOSE 10000

# Start Laravel bằng built-in server
CMD php artisan serve --host 0.0.0.0 --port $PORT
