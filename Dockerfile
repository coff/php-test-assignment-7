#
#
# Base install
#
FROM php:8.0-apache as base

LABEL vendor="Coff"

# Set common env variables
ENV TZ="UTC"
ENV APACHE_DOCUMENT_ROOT="/var/www/public"

RUN docker-php-ext-install bcmath
RUN a2enmod rewrite

COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

COPY --chown=root:root docker/php/php.ini /usr/local/etc/php/php.ini
COPY --chown=root:root docker/apache/000-default.conf /etc/apache2/sites-available/000-default.conf
COPY --chown=www-data:www-data . /var/www

RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

WORKDIR /var/www

#RUN composer install --no-interaction --no-ansi -o

#
# Build dev stuff
#
FROM base as local

RUN pecl install -f xdebug \
    && docker-php-ext-enable xdebug
