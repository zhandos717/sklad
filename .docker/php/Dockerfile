FROM php:8.2.0-fpm

# Set working directory
WORKDIR /var/www/public

# Install dependencies
RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    libzip-dev\
    libonig-dev \
    locales \
    zip \
    jpegoptim optipng pngquant gifsicle \
    vim \
    unzip \
    git \
    curl \
    libz-dev \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Install extensions
RUN apt-get update && apt-get install -y libmcrypt-dev git libzip-dev zip libpq-dev  libxml2-dev libfreetype6-dev  libjpeg62-turbo-dev libmcrypt-dev  libpng-dev libicu-dev locales
RUN docker-php-ext-configure zip && docker-php-ext-install pgsql  pdo_pgsql zip soap gd intl


# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Add user for laravel application
RUN groupadd -g 1000 www \
    && useradd -u 1000 -ms /bin/bash -g www www

RUN chmod -R 775 /var/www/public
# Copy existing application directory permissions
COPY --chown=www:www . /var/www/public


# Cleaning
RUN apt-get clean && apt-get autoremove -y


# set timezone
ENV TZ="Asia/Almaty"

# Change current user to www
USER www

# Expose port 9000 and start php-fpm server
EXPOSE 9000
CMD ["php-fpm"]
