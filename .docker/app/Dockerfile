FROM php:7.1-apache

MAINTAINER Matus Petrofcik

RUN curl -sL https://deb.nodesource.com/setup_8.x | bash -
RUN curl -sS https://dl.yarnpkg.com/debian/pubkey.gpg | apt-key add -
RUN echo "deb https://dl.yarnpkg.com/debian/ stable main" | tee /etc/apt/sources.list.d/yarn.list

RUN apt-get update \
&& apt-get install -y --no-install-recommends git nodejs yarn libicu-dev \
&& docker-php-ext-install pdo_mysql intl opcache \
&& docker-php-ext-enable intl opcache

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

COPY . /srv/app

COPY .docker/app/000-default.conf /etc/apache2/sites-available/000-default.conf

RUN chown -R www-data:www-data /srv/app

RUN a2enmod rewrite && service apache2 restart

# Permission fix
RUN usermod -u 1000 www-data

WORKDIR /srv/app
