FROM php:8.2-apache

RUN docker-php-ext-install mysqli pdo pdo_mysql

RUN echo 'AddType image/svg+xml .svg' >> /etc/apache2/apache2.conf \
    && sed -i 's/AllowOverride None/AllowOverride All/g' /etc/apache2/apache2.conf
