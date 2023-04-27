#!/bin/bash

# Change ownership
chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Change permissions
cmmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Start Apache in the foreground. This takes the place of "CMD ["apache2-foreground"]" in the Dockerfile!
exec apache2-foreground
