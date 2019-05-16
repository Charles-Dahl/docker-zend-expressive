FROM php:7.3.5-apache

RUN a2enmod rewrite

RUN apt-get update && apt-get install -y libxml2-dev
RUN docker-php-ext-install soap
RUN docker-php-ext-install pdo pdo_mysql

#changes the document root to the environment variable APACHE_DOCUMENT_ROOT
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf