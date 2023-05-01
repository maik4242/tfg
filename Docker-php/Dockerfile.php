FROM php:7.4.26-apache

RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli && apachectl restart

COPY ./src/ /var/www/html/

EXPOSE 80