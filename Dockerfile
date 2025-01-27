FROM php:8.3-fpm

# Copy custom PHP configuration
COPY ./docker/php/php.ini /usr/local/etc/php/conf.d/php.ini

WORKDIR /var/www

# Install composer
ENV COMPOSER_ALLOW_SUPERUSER=1
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install postgresql and unzip utility and libs needed by zip PHP extension 
RUN apt-get update && apt-get install -y zlib1g-dev libzip-dev unzip libpq-dev

RUN docker-php-ext-install zip pgsql pdo_pgsql
