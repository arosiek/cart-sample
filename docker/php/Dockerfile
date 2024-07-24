FROM php:8.3-fpm

RUN apt-get update && \
    apt-get install -y \
        libzip-dev \
        unzip \
        git \
        libicu-dev \
        libxml2-dev && \
    docker-php-ext-configure intl && \
    docker-php-ext-install intl zip && \
    docker-php-ext-enable intl zip

# Install Xdebug
RUN pecl install xdebug && \
    docker-php-ext-enable xdebug

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copy configuration files
COPY conf.d/xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini

# Set the working directory
WORKDIR /var/www

# Set proper permissions (adjust as necessary)
RUN chown -R www-data:www-data /var/www

# Expose the port on which PHP-FPM will listen
EXPOSE 9000

# Start PHP-FPM server
CMD ["php-fpm"]
