FROM php:7.4-fpm-alpine

RUN apk update; \
    apk upgrade;

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN composer global require hirak/prestissimo

RUN docker-php-ext-install pdo_mysql
