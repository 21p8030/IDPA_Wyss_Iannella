FROM php:7.4-apache

RUN apt-get update && apt-get -y dist-upgrade
RUN apt-get update && \
        apt-get install -y \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libmcrypt-dev \
        libpng-dev \
        libpq-dev \
        libxml2-dev \
        libzip-dev \
        locales \
        unzip \
    && docker-php-ext-install -j$(nproc) zip opcache \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd \
    && docker-php-ext-install pdo_mysql

RUN yes ''| pecl install xdebug-2.9.5 && docker-php-ext-enable xdebug

# install composer
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" && \
    php composer-setup.php --install-dir=/usr/bin --filename=composer && \
    php -r "unlink('composer-setup.php');"

# config file:
COPY php.ini /usr/local/etc/php/php.ini


# Configure apache
COPY apache-default.conf /etc/apache2/sites-available/000-default.conf
RUN a2enmod rewrite headers

RUN echo "de_CH.UTF-8 UTF-8\nfr_CH.UTF-8 UTF-8" >> /etc/locale.gen && locale-gen
ENV LANG de_CH.UTF-8
ENV LANGUAGE de_CH:en
ENV LC_ALL de_CH.UTF-8
RUN cp /usr/share/zoneinfo/Europe/Zurich /etc/localtime

WORKDIR /var/www/html

CMD composer install && apache2-foreground
