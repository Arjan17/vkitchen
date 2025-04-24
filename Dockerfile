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

# Expose the application port
EXPOSE 80

# Configure Apache to serve from Laravel's public directory
RUN echo '<VirtualHost *:80>
    DocumentRoot /var/www/html/public
    <Directory /var/www/html/public>
        Options Indexes FollowSymLinks
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>' > /etc/apache2/sites-available/000-default.conf

# Restart Apache to apply the configuration
RUN service apache2 restart

# Set permissions for Laravel directories
RUN chmod -R 755 /var/www/html/public \
    && chmod -R 775 /var/www/html/storage \
    && chmod -R 775 /var/www/html/bootstrap/cache

# Enable mod_rewrite for Laravel routing
RUN a2enmod rewrite && service apache2 restart
