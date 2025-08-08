# Composer stage
FROM composer:2 AS composer
WORKDIR /app
COPY ./app/composer.json ./
RUN composer install --no-dev --optimize-autoloader

# Final stage
FROM php:8.1-fpm-alpine
WORKDIR /app
COPY --from=composer /usr/bin/composer /usr/bin/composer
COPY --from=composer /app/vendor ./vendor
COPY ./app .