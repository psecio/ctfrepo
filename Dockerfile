FROM php:7.2-apache

RUN apt-get update && apt-get install -y --no-install-recommends \
    curl git vim libpng-dev libcurl4-openssl-dev sudo zip cron wget mysql-client mysql-client
RUN docker-php-ext-install mysqli pdo pdo_mysql gd curl

COPY . /var/www/html
COPY ./000-default.conf /etc/apache2/sites-enabled/000-default.conf

RUN /usr/sbin/apachectl restart