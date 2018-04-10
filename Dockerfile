FROM php:7.2-apache

RUN apt-get update && apt-get install -y --no-install-recommends \
    curl git vim libpng-dev libcurl4-openssl-dev sudo zip cron wget mysql-client netcat
RUN docker-php-ext-install mysqli pdo pdo_mysql gd curl

COPY . /var/www/html
COPY ./000-default.conf /etc/apache2/sites-enabled/000-default.conf

RUN a2enmod rewrite
RUN a2enmod vhost_alias

RUN /usr/sbin/apachectl restart

# App-specific
COPY ./.env-prod /var/www/html/.env
COPY ./phinx.yml-prod /var/www/html/phinx.yml

WORKDIR /var/www/html