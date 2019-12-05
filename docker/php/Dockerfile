FROM php:7.2.7-fpm-alpine3.7

RUN apk update; \
    apk upgrade;

RUN docker-php-ext-install mysqli

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN composer global require hirak/prestissimo

RUN docker-php-ext-install pdo_mysql
