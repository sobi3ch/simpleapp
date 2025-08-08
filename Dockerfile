# Start from the base PHP-FPM image
FROM php:8.1-fpm-alpine

# Set the working directory inside the container
WORKDIR /var/www/html

# Copy the application code from your local machine into the container
COPY ./app /app