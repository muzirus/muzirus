FROM php:7.1-apache

MAINTAINER Matus Petrofcik

RUN curl -sL https://deb.nodesource.com/setup_8.x | bash -

RUN curl -sS https://dl.yarnpkg.com/debian/pubkey.gpg | apt-key add -
RUN echo "deb https://dl.yarnpkg.com/debian/ stable main" | tee /etc/apt/sources.list.d/yarn.list

RUN apt-get update \
 && apt-get install -y --no-install-recommends git zlib1g-dev libicu-dev nodejs yarn \
 && docker-php-ext-configure intl \
 && docker-php-ext-install intl gettext zip pdo pdo_mysql  \
 && a2enmod rewrite \
 && mv /var/www/html /var/www/public

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

COPY . /srv/app
COPY .docker/vhost.conf /etc/apache2/sites-available/000-default.conf

RUN chown -R www-data:www-data /srv/app

WORKDIR /var/www
