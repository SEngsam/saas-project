FROM php:8.2-fpm

RUN apt-get update && apt-get install -y \
    git \
    unzip \
    curl \
    zip \
    libzip-dev \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libjpeg-dev \
    libpq-dev \
    libicu-dev \
    libssl-dev \
    libxslt1-dev \
    libcurl4-openssl-dev \
    pkg-config \
    libmcrypt-dev \
    && docker-php-ext-install pdo pdo_mysql mbstring zip exif pcntl

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
