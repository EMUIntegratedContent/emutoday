FROM php:8.1-apache

RUN apt-get update && \
    apt-get install -y libonig-dev libzip-dev zip unzip git libpng-dev libfreetype6-dev libjpeg62-turbo-dev && \
    docker-php-ext-install pdo_mysql mysqli zip gd

COPY . /var/www/html/

RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
RUN chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN a2enmod rewrite

# Set the DocumentRoot for Apache
ENV APACHE_DOCUMENT_ROOT /var/www/html/public

# Copy the Apache virtual host configuration file to the container
COPY ./docker/vhost.conf /etc/apache2/sites-available/000-default.conf

CMD ["apache2-foreground"]
