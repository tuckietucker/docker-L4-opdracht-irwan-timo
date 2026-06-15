FROM php:8.2-apache

# Install the PDO MySQL driver required by the application
RUN docker-php-ext-install pdo_mysql

# Enable apache rewrite module (if needed for modern PHP routes)
RUN a2enmod rewrite
