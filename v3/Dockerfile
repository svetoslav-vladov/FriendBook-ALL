FROM php:8.3-apache

RUN a2enmod rewrite

RUN apt-get update \
    && apt-get install -y \
        libpng-dev \
        libjpeg62-turbo-dev \
        libfreetype6-dev \
        libwebp-dev \
        zlib1g-dev \
    && docker-php-ext-configure gd \
        --with-freetype \
        --with-jpeg \
        --with-webp \
    && docker-php-ext-install \
        pdo_mysql \
        gd \
    && rm -rf /var/lib/apt/lists/*

RUN printf '%s\n' \
    '#!/bin/sh' \
    'mkdir -p /var/www/html/uploads/users/photos/fullsized' \
    'mkdir -p /var/www/html/uploads/users/photos/thumbs' \
    'chmod -R 777 /var/www/html/uploads' \
    'exec apache2-foreground' \
    > /usr/local/bin/friendbook-entrypoint \
    && chmod +x /usr/local/bin/friendbook-entrypoint

ENTRYPOINT ["friendbook-entrypoint"]

RUN printf '%s\n' \
    '<Directory /var/www/html>' \
    '    AllowOverride All' \
    '    Require all granted' \
    '</Directory>' \
    > /etc/apache2/conf-available/friendbook.conf \
    && a2enconf friendbook