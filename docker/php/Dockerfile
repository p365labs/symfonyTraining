FROM php:7.1-fpm-alpine

USER root

RUN apk add --no-cache \
		git \
        bzip2-dev \
        libxml2-dev \
        icu-dev \
        libpng \
        libjpeg-turbo \
        freetype-dev \
        libpng-dev \
        libjpeg-turbo-dev \
        g++ \
        curl \
        libmcrypt-dev \
        php7-tidy \
        nodejs \
        nodejs-npm \
        tzdata \
        shadow \
        $PHPIZE_DEPS \
        vim \
        acl \
        sudo \
        mysql-client \
	&& docker-php-ext-install -j2 \
		mcrypt \
		intl \
		zip \
		bcmath \
		soap \
		gd \
		zip \
		pdo_mysql \
		opcache \
	&& pecl install xdebug \
	&& docker-php-ext-enable xdebug \
	&& pecl clear-cache \
	&& mv /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini.disabled \
	&& kill -USR2 1
#xdebug.max_nesting_level = 10000
RUN apk add gnu-libiconv --update-cache --repository http://dl-cdn.alpinelinux.org/alpine/edge/testing/ --allow-untrusted
ENV LD_PRELOAD /usr/lib/preloadable_libiconv.so php

ENV TZ Europe/Rome

RUN curl -sS https://getcomposer.org/installer | php -- \
        --install-dir=/usr/local/bin --filename=composer \
		--version 1.7.2

RUN apk add --no-cache yarn

WORKDIR /var/www/html

RUN usermod -u 1000 www-data
RUN mkdir -p /var/www/html/var/cache \
    && mkdir -p /var/www/html/var/sessions \
    && mkdir -p /var/www/html/var/logs \
    && chown -R www-data:www-data /var/www/html/var/cache \
    && chown -R www-data:www-data /var/www/html/var/logs \
    && chown -R www-data:www-data /var/www/html/var/sessions \
    && chmod -R 777 /var/www/html/var
#RUN chown -R www-data:www-data /var/www/html/var/cache
#RUN chown -R www-data:www-data /var/www/html/var/logs
#RUN chown -R www-data:www-data /var/www/html/var/sessions

#RUN chmod 777 -R /var/www/html/var/sessions \
#    && chmod 777 -R /var/www/html/var/logs \
#    && chmod 777 -R /var/www/html/var/cache

#RUN chmod -R 777 /var/www/html/

EXPOSE 9000

