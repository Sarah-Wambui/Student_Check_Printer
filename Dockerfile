# ============================================
# Stage 1: Composer build
# ============================================
FROM php:8.2-fpm AS build

RUN apt-get update && apt-get install -y \
    git unzip libzip-dev libpng-dev libonig-dev libxml2-dev libicu-dev libcurl4-openssl-dev pkg-config \
    libfreetype6-dev libjpeg62-turbo-dev zlib1g-dev \
    && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-install pdo pdo_mysql zip exif pcntl bcmath gd intl

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

COPY composer.json composer.lock ./
RUN composer install --no-dev --no-interaction --no-scripts --prefer-dist --optimize-autoloader

COPY . .


# ============================================
# Stage 2: Node build
# ============================================
FROM node:20 AS nodebuild

WORKDIR /var/www

COPY . .
RUN npm install
RUN npm run build   # creates public/build + manifest.json


# ============================================
# Stage 3: Production — PHP + Nginx + Supervisor
# ============================================
FROM php:8.2-fpm

RUN apt-get update && apt-get install -y nginx supervisor default-mysql-client \
    libzip-dev libpng-dev libonig-dev libxml2-dev libicu-dev libcurl4-openssl-dev pkg-config \
    libfreetype6-dev libjpeg62-turbo-dev zlib1g-dev \
    && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-install pdo pdo_mysql zip exif pcntl bcmath gd intl

WORKDIR /var/www

# Copy PHP app
COPY --from=build /var/www /var/www

# Copy Vite/Tailwind build output
COPY --from=nodebuild /var/www/public/build /var/www/public/build

# Nginx config
RUN rm -f /etc/nginx/conf.d/default.conf /etc/nginx/sites-enabled/default
COPY ./nginx/default.conf /etc/nginx/conf.d/default.conf

# Supervisor config
COPY supervisord.conf /etc/supervisor/conf.d/supervisord.conf

# Permissions
RUN chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

ENV PORT=8080
EXPOSE 8080

# Copy entrypoint
COPY entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

# Set entrypoint
ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]

