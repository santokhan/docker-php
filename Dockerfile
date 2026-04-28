FROM php:8.2-apache

# Install mysqli + pdo_mysql extensions
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Enable rewrite module (CRITICAL for routing)
RUN a2enmod rewrite

RUN echo '\
<Directory /var/www/html>\n\
    AllowOverride All\n\
</Directory>\n\
' >> /etc/apache2/apache2.conf