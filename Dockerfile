FROM php:7.4-fpm-alpine

ARG UID

WORKDIR /var/www/html

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install PHP extensions end

RUN addgroup -g ${UID} developer && adduser -G developer -g developer -s /bin/sh -D developer
 
USER developer