#!/bin/bash

# Wait for database using PHP
until php -r "new PDO('mysql:host=$DB_HOST;port=$DB_PORT;dbname=$DB_DATABASE', '$DB_USERNAME', '$DB_PASSWORD');" >/dev/null 2>&1; do
    echo "Waiting for database..."
    sleep 2
done

# Run migrations and seeders
php artisan migrate --force
php artisan db:seed --force

# Start Nginx + PHP-FPM via supervisord
exec /usr/bin/supervisord -c /etc/supervisor/conf.d/supervisord.conf
