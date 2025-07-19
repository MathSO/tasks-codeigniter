FROM php:8.3.6-fpm-alpine3.19


WORKDIR /apps

RUN apk add icu-dev libpq-dev
RUN docker-php-ext-install intl pgsql

COPY --from=composer:2.8.9 /usr/bin/composer /usr/bin/composer

COPY . ./
RUN composer install
RUN chown -R www-data:www-data writable/