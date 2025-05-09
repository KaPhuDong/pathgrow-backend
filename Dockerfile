# Use PHP 8.3 CLI with Alpine Linux
FROM php:8.3-cli-alpine

# Install Composer
COPY --from=composer:2.6 /usr/bin/composer /usr/bin/composer

# Install required PHP extensions
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Create application directory
WORKDIR /app

# Copy all source code and libraries
COPY . .

# Set permissions for storage and bootstrap/cache (avoid permission issues)
RUN chmod -R 777 storage bootstrap/cache

# Install dependencies from composer.lock
RUN COMPOSER_ALLOW_SUPERUSER=1 composer install --no-dev --optimize-autoloader

# Expose port 1000 for external access
EXPOSE 8080

# Run Laravel application
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8080"]
