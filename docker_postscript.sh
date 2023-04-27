#!/bin/bash

# Change ownership
chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache /var/www/html/public

# Change permissions
chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache /var/www/html/public

# Install all composer vendor packages and change the ownership and permissions of the directory
vendordir="/var/www/html/vendor"
if [ ! -d "$vendordir" ]; then
    mkdir "$vendordir"
    chown -R www-data:www-data "$vendordir"
    chmod -R 775 "$vendordir"
    echo "Directory $directory added successfully with www-data ownership."
fi

cd /var/www/html
composer self-update
composer clear-cache
composer update --prefer-dist --no-progress --no-interaction

# Start Apache in the foreground. This takes the place of "CMD ["apache2-foreground"]" in the Dockerfile!
exec apache2-foreground
