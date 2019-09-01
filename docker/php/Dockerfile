FROM php:7.2.3-fpm

RUN apt-get update && apt-get install -y --no-install-recommends --no-install-suggests \
    apt-transport-https \
    apt-utils \
    ca-certificates \
    curl \
    git \
    gnupg2 \
    libicu-dev \
    unzip \
    zip \
    wget

RUN docker-php-ext-install pdo_mysql \
    && docker-php-ext-install intl

RUN docker-php-ext-configure intl

RUN curl -sSk https://getcomposer.org/installer | php -- --disable-tls && \
	mv composer.phar /usr/local/bin/composer

RUN composer global require hirak/prestissimo

RUN curl -sL https://deb.nodesource.com/setup_12.x | bash - \
    && apt-get install -y nodejs

WORKDIR /usr/src/muzirus

COPY . /usr/src/muzirus

RUN groupadd --system --gid 1000 muzirus

RUN useradd --system --create-home --home-dir /home/muzirus --shell /bin/bash --uid 1000 --gid 1000 muzirus

RUN PATH=$PATH:/usr/src/muzirus/vendor/bin:bin
