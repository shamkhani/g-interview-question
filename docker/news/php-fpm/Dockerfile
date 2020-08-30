FROM php:7.3-fpm

MAINTAINER Mostafa Shamkhani <shamkhani@gmail.com>

#
#--------------------------------------------------------------------------
# Software's Installation
#--------------------------------------------------------------------------
#
# Installing tools and PHP extentions using "apt", "docker-php", "pecl",
#

# Install necessary packages
RUN apt-get update \
  && apt-get install -y --no-install-recommends \
    curl \
    libz-dev \
    libssl-dev \
    libjpeg-dev \
    libpng-dev \
    libmcrypt-dev \
    zip unzip \
    git \
    autoconf 


# Install the PHP pdo_mysql extention
RUN docker-php-ext-install pdo_mysql

# Set timezone
ENV TZ=Asia/Tehran
RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone

#####################################
# xDebug:
#####################################
ARG INSTALL_XDEBUG=false
RUN if [ ${INSTALL_XDEBUG} = true ]; then \
    # Install the xdebug extension
    pecl install xdebug && \
    docker-php-ext-enable xdebug \
;fi

# Copy xdebug configuration for remote debugging
COPY ./xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini

#####################################
# Opcache:
#####################################
ARG INSTALL_OPCACHE=false
RUN if [ ${INSTALL_OPCACHE} = true ]; then \
    docker-php-ext-configure opcache && \
    docker-php-ext-install opcache &&\
    docker-php-ext-enable opcache \
;fi

COPY ./opcache.ini /usr/local/etc/php/conf.d/opcache.ini

#
#--------------------------------------------------------------------------
# Application's Installation
#--------------------------------------------------------------------------
#
# Installing the application and performs the commands we need to build it
#

#####################################
# Composer:
#####################################

# Install composer and add its bin to the PATH.
RUN curl -s http://getcomposer.org/installer | php && \
    echo "export PATH=${PATH}:/var/www/news_monolothic/vendor/bin" >> ~/.bashrc && \
    mv composer.phar /usr/local/bin/composer

# Create the www-data user
RUN usermod -u 1000 www-data

# Create the web root directory and change the working directory
RUN mkdir -p /var/www/news_monolothic && chown www-data:www-data -R /var/www

USER www-data

ARG GIT_USER
ARG GIT_TOKEN
ARG GIT_PASSWORD
ARG RELEASE_BRANCH=master


#
#--------------------------------------------------------------------------
# Final Touch
#--------------------------------------------------------------------------
#

USER root

COPY ./pool.conf /usr/local/etc/php-fpm.d/pool.conf
COPY ./www.conf /usr/local/etc/php-fpm.d/www.conf
COPY ./php.ini /usr/local/etc/php-fpm.d/php.ini

RUN rm -r /var/lib/apt/lists/*

COPY ./docker-entrypoint.sh /usr/local/bin/docker-entrypoint.sh
RUN chmod +x /usr/local/bin/docker-entrypoint.sh

WORKDIR /var/www/


# RUN bash -c "cd /var/www/news_monolothic && composer require /var/www/news_monolothic/composer.json && php artisan migrate --force "
# RUN bash -c "cd /var/www/news_monolothic && composer install && php artisan migrate --force "
# RUN bash -c "cd /var/www/news_monolothic && composer install && php artisan migrate --force "

CMD ["php-fpm"]

EXPOSE 9000