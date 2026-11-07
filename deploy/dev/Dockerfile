FROM php:8.4-fpm-alpine

WORKDIR /var/www/laravel

RUN apk add --no-cache \
    postgresql-dev \
    libzip-dev \
    zip \
    unzip \
    git \
    curl

RUN docker-php-ext-install pdo \
    pdo_pgsql \
    pgsql \
    zip \
    opcache

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer