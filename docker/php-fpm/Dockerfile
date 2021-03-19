FROM php:7.4-fpm-alpine
USER root

RUN apk update
# install php gd extension
RUN apk add gd
RUN docker-php-ext-install pdo pdo_mysql

WORKDIR /var/www/html