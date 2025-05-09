# Sử dụng PHP 8.3 Alpine làm base image
FROM php:8.3-cli-alpine

# Cài Composer
COPY --from=composer:2.6 /usr/bin/composer /usr/bin/composer

# Cài các PHP extension cần thiết
RUN docker-php-ext-install pdo pdo_mysql

# Cài thêm các tiện ích hỗ trợ (tùy chọn)
RUN apk add --no-cache bash

# Tạo thư mục làm việc
WORKDIR /app

# Copy toàn bộ source code Laravel vào container
COPY . .

# Cấp quyền cho các thư mục storage và bootstrap/cache
RUN chmod -R 777 storage bootstrap/cache

# Cài đặt các package qua Composer
RUN COMPOSER_ALLOW_SUPERUSER=1 composer install --no-dev --optimize-autoloader

# Xóa cache cũ và cache lại config
RUN php artisan config:clear && php artisan config:cache

# Render yêu cầu sử dụng port 8080
EXPOSE 8080

# Khởi động Laravel bằng built-in server
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8080"]
