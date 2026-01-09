FROM php:8.2-fpm

ARG USER=user
ARG UID=1000
ARG PORT=9000
ARG WORKDIR=/var/www

EXPOSE $PORT

RUN apt-get update && apt-get install -y \
    git \
    curl \
    unzip \
    zip \
    libzip-dev \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libicu-dev \
    libpq-dev \
    nodejs \
    npm \
    && docker-php-ext-install \
    pdo \
    pdo_pgsql \
    mbstring \
    zip \
    exif \
    pcntl \
    intl \
    gd

RUN pecl install \
    mailparse \
    redis && \
    docker-php-ext-enable \
    mailparse \
    redis


COPY --from=composer:2.8.4 /usr/bin/composer /usr/bin/composer


RUN useradd -G www-data,root -u $UID -d /home/$USER $USER && \
    mkdir -p /home/$USER/.composer && \
    chown -R $USER:$USER /home/$US

WORKDIR $WORKDIR

USER $USER
