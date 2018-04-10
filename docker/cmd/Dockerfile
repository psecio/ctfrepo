FROM php:7.2

RUN apt-get update && apt-get install -y --no-install-recommends \
    curl git libpng-dev libcurl4-openssl-dev sudo zip wget mysql-client
RUN docker-php-ext-install mysqli pdo pdo_mysql

COPY . /var/www/html
RUN chmod +x /var/www/html/migrate.sh

# App-specific
COPY ./.env-prod /var/www/html/.env
COPY ./phinx.yml-prod /var/www/html/phinx.yml