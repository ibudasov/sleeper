FROM autodoc/php7.1-apache
#todo: use alpine

WORKDIR /home/application

# Cloning from git
RUN rm -rf  /home/application && mkdir /home/application
RUN git clone https://github.com/ibudasov/sleeper.git .

RUN chown -R application:application .

# Composer shouldn't be running from root
USER application

RUN composer install

EXPOSE 8000

ENTRYPOINT ["php", "/home/application/bin/console", "server:run"]
