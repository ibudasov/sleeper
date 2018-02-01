FROM php:7.1-fpm-alpine

# Install needed software and XDebug support for code coverage tool
RUN apk update \
    && apk add  --no-cache git curl \
    && apk add --no-cache --virtual build-dependencies icu-dev g++ make autoconf \
    && pecl install xdebug  \
    && docker-php-ext-enable xdebug  \
    && echo "xdebug.remote_enable=on" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.remote_autostart=off" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.remote_port=9000" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.remote_handler=dbgp" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.remote_connect_back=0" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && apk del build-dependencies \
    && rm -rf /tmp/*

WORKDIR /home/application

# Cloning from git
RUN rm -rf  /home/application && mkdir /home/application
RUN git clone https://github.com/ibudasov/sleeper.git .

# Composer install
RUN curl -sS https://getcomposer.org/installer | php
RUN mv composer.phar /usr/local/bin/composer

# Composer shouldn't be running from root
RUN adduser -D -u 1000 application
RUN chown -R application:application .
USER application
RUN composer install

# RUN ps -f

# https://github.com/wsargent/docker-cheat-sheet
EXPOSE 8000

# https://www.ctl.io/developers/blog/post/dockerfile-entrypoint-vs-cmd/
# https://symfony.com/doc/3.4/setup/built_in_web_server.html
CMD ["php", "/home/application/bin/console", "server:run", "*:8000"]
