FROM php:8.1-apache

#copy virtual host file into the container
COPY 000-default.conf /etc/apache2/sites-available/000-default.conf

#enable rewrite mode
RUN a2enmod rewrite

#install packages
RUN apt-get update && \
    apt-get install \
    libzip-dev \
    wget \
    git \
    unzip \
    -y --no-install-recommends

# install php extensions
RUN docker-php-ext-install zip pdo_mysql

#copy compose installable
COPY ./install-composer.sh ./

#copy php.ini
COPY ./php.ini /usr/local/etc/php/

#clean packages and install composer
RUN apt-get purge -y g++ \
    && apt-get autoremove -y \
    && rm -r /var/lib/apt/lists/* \
    && rm -rf /tmp/* \
    && sh ./install-composer.sh \
    && rm ./install-composer.sh

#change working directory
WORKDIR /var/www

#chnage the container owner to root
RUN chown -R www-data:www-data /var/www

#start apache
CMD [ "apache2-foreground" ]