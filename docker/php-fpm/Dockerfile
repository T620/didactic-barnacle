FROM php:8.3-fpm as development

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libzip-dev \
    libxml2-dev \
    zip \
    unzip \
    vim

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install -j$(nproc) \
    pdo_mysql \
    zip \
    bcmath \
    opcache \
    exif \
    pcntl \
    gd

# Needed for NumberFormatter, not sure why
#RUN docker-php-ext-configure intl && docker-php-ext-install intl

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Set recommended PHP settings
USER www-data

# Copy php-fpm configuration
COPY ./docker/php-fpm/conf/php.ini /usr/local/etc/php/conf.d/app.ini

# copy opcache configuration
COPY ./docker/php-fpm/conf/opcache.ini /usr/local/etc/php/conf.d/opcache.ini


# Set the working directory to /var/www
WORKDIR /var/www

# Expose port 9000 and start php-fpm server
EXPOSE 9000
CMD ["php-fpm"]

FROM development AS production
COPY --chown=www-data:www-data ./bin /var/www/bin
COPY --chown=www-data:www-data ./config /var/www/config
COPY --chown=www-data:www-data ./public /var/www/public
COPY --chown=www-data:www-data ./src /var/www/src
COPY --chown=www-data:www-data ./var /var/www/var
COPY --chown=www-data:www-data ./composer.json /var/www
COPY --chown=www-data:www-data ./composer.lock /var/www

# CI creates this file for us in the pipeline
# called it .env.deploy so we can still build from local if needed
COPY --chown=www-data:www-data .env /var/www/.env
