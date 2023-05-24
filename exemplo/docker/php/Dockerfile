FROM php:8.2-fpm
LABEL maintainer="Iury Gomes de Oliveira"

# Install dependencies
RUN apt-get update && \
    apt-get -y --no-install-recommends install libcurl4-openssl-dev libmpdec-dev libmemcached-dev memcached apt-utils

RUN docker-php-ext-install pdo pdo_mysql curl opcache
RUN docker-php-ext-enable pdo_mysql 

ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/

RUN chmod +x /usr/local/bin/install-php-extensions && \
    install-php-extensions decimal memcached intl xdebug bcmath

RUN apt-get clean; \
    rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

EXPOSE 9000
CMD ["php-fpm"]