FROM php:7.4.8-apache

RUN apt-get update && apt-get install -y \
    libonig-dev \
    && docker-php-ext-install pdo_mysql mysqli mbstring
WORKDIR /var/www/html
COPY ./php.ini /usr/local/etc/php/