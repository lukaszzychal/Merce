FROM php:8.1-fpm-alpine3.17
COPY --from=composer /usr/bin/composer /usr/bin/composer
WORKDIR /var/www/html
