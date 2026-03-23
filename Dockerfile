FROM php:8.2-apache

RUN pecl install xdebug \
    && docker-php-ext-enable xdebug

COPY php.ini /usr/local/etc/php/

COPY apache.conf /etc/apache2/conf-available/servername.conf
RUN a2enconf servername

WORKDIR /var/www/html