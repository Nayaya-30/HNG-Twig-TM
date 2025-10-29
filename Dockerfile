# Use official PHP image with needed extensions
FROM php:8.1-apache

# Install dependencies, extensions
RUN apt-get update && apt-get install -y \
    libzip-dev unzip libpng-dev \
  && docker-php-ext-install zip pdo_mysql gd \
  && a2enmod rewrite

# Copy project files
COPY . /var/www/html/

# Install Composer and dependencies
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
WORKDIR /var/www/html
RUN composer install --no-dev --optimize-autoloader

# Ensure proper permissions
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache || true

# Expose web port
EXPOSE 80

# Use Apache to serve the site
CMD ["apache2-foreground"]
