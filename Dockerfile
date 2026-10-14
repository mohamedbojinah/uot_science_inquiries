FROM webdevops/php-nginx:8.2

# Set Nginx document root to Laravel's public directory
ENV WEB_DOCUMENT_ROOT=/app/public
ENV WEB_DOCUMENT_INDEX=index.php
ENV PHP_DATE_TIMEZONE=Africa/Tripoli

WORKDIR /app

# Copy application files
COPY . .

# Install composer dependencies
RUN composer install --no-interaction --optimize-autoloader --no-dev

# Setup .env file if not present
RUN if [ ! -f .env ]; then cp .env.example .env; fi

# Generate app encryption key
RUN php artisan key:generate --force

# Create and populate SQLite database during build
RUN mkdir -p database storage/framework/views storage/framework/sessions storage/framework/cache/data bootstrap/cache
RUN touch database/database.sqlite
RUN php artisan migrate --force --seed

# Fix all permissions for Nginx and PHP-FPM
RUN chown -R application:application /app
RUN chmod -R 777 /app/storage /app/bootstrap/cache /app/database

EXPOSE 80
