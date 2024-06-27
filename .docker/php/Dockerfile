FROM phpdockerio/php:8.3-fpm

ARG TIMEZONE

COPY php.ini /usr/local/etc/php/conf.d/docker-php-config.ini

RUN apt-get update \
    && apt-get -y --no-install-recommends install \
        php8.3-gd \
        php8.3-intl \
        php8.3-mbstring \
        php8.3-memcached \
        php8.3-mysql \
        php8.3-sqlite \
        php8.3-oauth \
        php8.3-redis \
        php8.3-uuid \
        php8.3-xdebug \
        php8.3-yaml \
        php8.3-amqp \
        php-pear \
        php8.3-dev \
        build-essential \
        openssl \
        unzip \
        git \
        wget \
        curl \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*

# Habilitar la extensión AMQP manualmente
RUN echo "extension=amqp.so" > /usr/local/etc/php/conf.d/docker-php-ext-amqp.ini

# Set timezone
RUN ln -snf /usr/share/zoneinfo/${TIMEZONE} /etc/localtime \
    && echo ${TIMEZONE} > /etc/timezone \
    && printf '[PHP]\ndate.timezone = "%s"\n' ${TIMEZONE} > /usr/local/etc/php/conf.d/tzone.ini \
    && date

# Instalar Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Instalar Symfony CLI
RUN curl -sS https://get.symfony.com/cli/installer | bash

# Mover Symfony CLI a directorio global
RUN mv /root/.symfony5/bin/symfony /usr/local/bin/symfony

USER root

# Configurar permisos de directorio
RUN mkdir -p /var/www/symfony/var/log /var/www/symfony/var/cache/prod /var/www/symfony/var/cache/dev /var/www/symfony/var/cache/test /var/log \
    && chown -R www-data:www-data /var/www/symfony/var/ \
    && chmod -R ug+rwX /var/www/symfony/var/

WORKDIR /var/www/symfony

# Instalar Node.js y Yarn desde NodeSource
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs \
    && npm install -g yarn \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*
