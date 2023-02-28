FROM php:8.0.22-fpm-buster

# Install basic packages and extensions
RUN apt-get update \
  && apt-get install -y zlib1g-dev libzip-dev wget gnupg procps libgmp3-dev \
  && docker-php-ext-install zip opcache bcmath gmp

# Composer install
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer --version=1.10.22

ENV COMPOSER_ALLOW_SUPERUSER 1

WORKDIR /var/www/app
