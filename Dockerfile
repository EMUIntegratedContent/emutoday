FROM php:8.3-apache

# Set the DocumentRoot for Apache
ENV APACHE_DOCUMENT_ROOT /var/www/html/public

RUN apt-get update && \
    apt-get install -y libonig-dev libzip-dev zip unzip git libpng-dev libfreetype6-dev libjpeg62-turbo-dev
RUN docker-php-ext-configure gd --enable-gd --with-freetype --with-jpeg
RUN docker-php-ext-install pdo_mysql mysqli zip gd exif

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN a2enmod rewrite

# Copy the Apache virtual host configuration file to the container
COPY docker_vhost.conf /etc/apache2/sites-available/000-default.conf

# Copy the shell script into the container
COPY docker_postscript.sh /usr/local/bin/docker_postscript.sh

# Copy the custom PHP configuration file into the container
COPY custom-php.ini /usr/local/etc/php/php.ini

# Set executable permissions for the shell script
RUN chmod +x /usr/local/bin/docker_postscript.sh

# Set the entrypoint to execute the shell script
ENTRYPOINT ["/usr/local/bin/docker_postscript.sh"]

