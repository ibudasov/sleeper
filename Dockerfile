FROM php:7.1-fpm-alpine

RUN apk update && apk upgrade && apk add git

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
RUN composer run &

# RUN ps -f

# https://github.com/wsargent/docker-cheat-sheet
EXPOSE 8000

# https://www.ctl.io/developers/blog/post/dockerfile-entrypoint-vs-cmd/
# https://symfony.com/doc/3.4/setup/built_in_web_server.html
ENTRYPOINT ["php", "/home/application/bin/console", "server:run", "*:8000"]
