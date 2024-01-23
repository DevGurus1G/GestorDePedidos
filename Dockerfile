FROM php:8.1-apache
RUN docker-php-ext-install mysqli pdo pdo_mysql
# Install zip extension (needed for composer)
RUN apt-get update \
     && apt-get install -y libzip-dev \
     && docker-php-ext-install zip
# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
# Override docker-php.conf used by Apache. New file includes Options Indexes option.
COPY ./docker-php.conf /etc/apache2/conf-enabled/docker-php.conf
# Configure php.ini to display errors:
RUN cp /usr/local/etc/php/php.ini-development /usr/local/etc/php/php.ini
