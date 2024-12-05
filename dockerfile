FROM php:8.1-fpm
RUN apt-get update && apt-get install -y libpq-dev git unzip \
    && docker-php-ext-install pdo pdo_mysql
COPY . /var/www/html
WORKDIR /var/www/html