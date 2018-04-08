FROM php:7.2-apache

RUN apt-get update && apt-get install -y --no-install-recommends \
    curl git vim libpng-dev libcurl4-openssl-dev sudo zip cron wget mysql-client mysql-client
RUN docker-php-ext-install mysqli pdo pdo_mysql gd curl

COPY . /var/www/html
COPY ./000-default.conf /etc/apache2/sites-enabled/000-default.conf

RUN /usr/sbin/apachectl restart

# App-specific
COPY /var/www/html/.env-prod /var/www/html/.env
COPY /var/www/html/phinx.yml-prod /var/www/html/phinx.yml

WORKDIR /var/www/html
RUN vendor/bin/phinx migrate
RUN vendor/bin/phinx seed:run