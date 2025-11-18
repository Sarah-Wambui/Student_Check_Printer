#!/bin/bash

# Wait for the database to be ready
until mysqladmin ping -h"$DB_HOST" -u"$DB_USERNAME" -p"$DB_PASSWORD" --silent; do
    echo "Waiting for database..."
    sleep 2
done

# Run migrations and seeders
php artisan migrate --force
php artisan db:seed --force

# Start Nginx + PHP-FPM via supervisord
exec /usr/bin/supervisord -c /etc/supervisor/conf.d/supervisord.conf
