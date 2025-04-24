# Use the official PHP image with Apache
FROM php:8.1-apache

# Install system dependencies and PHP extensions
RUN apt-get update && apt-get install -y \
    zip unzip libpq-dev libonig-dev libzip-dev && \
    docker-php-ext-install pdo_mysql mbstring zip

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set the working directory inside the container
WORKDIR /var/www/html

# Copy the application files into the container
COPY . /var/www/html

# Copy Apache configuration file into the container
COPY 000-default.conf /etc/apache2/sites-available/000-default.conf

# Enable the new Apache configuration
RUN a2ensite 000-default.conf

# Expose the application port
EXPOSE 80

# Restart Apache to apply the configuration
CMD ["apache2-foreground"]