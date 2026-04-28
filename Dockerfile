FROM php:8.2-apache

# Install mysqli + pdo_mysql extensions
RUN docker-php-ext-install mysqli pdo pdo_mysql