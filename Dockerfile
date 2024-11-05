FROM php:8.3-apache

# PHP setup
RUN apt update \
    && apt install -y g++ zip git \
    && apt install -y zlib1g-dev libicu-dev libzip-dev libonig-dev libpng-dev \
    && docker-php-ext-install intl opcache \
    && docker-php-ext-install pdo mysqli pdo_mysql \
    && pecl install apcu \
    && docker-php-ext-enable apcu \
    && docker-php-ext-configure zip \
    && docker-php-ext-install zip \
    && docker-php-ext-install mbstring \
    && docker-php-ext-install gd \
    && docker-php-ext-enable mbstring \
    && docker-php-ext-install pcntl \
    && apt-get install -y git

# Nodejs Setup
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs

# Composer Setup
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer


# System Setup
WORKDIR /var/www/html

COPY . .

RUN chmod +x start-container.sh

ENV APACHE_DOCUMENT_ROOT=/var/www/html/public

RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

RUN if [ -d "/var/www/html/storage"]; then chown -R www-data:www-data /var/www/html/storage; fi
RUN if [ -d "/var/www/html/bootstrap/cache"]; then chown -R www-data:www-data /var/www/html/bootstrap/cache; fi

RUN useradd -G www-data,root -u 100 -d /home/devuser devuser

RUN mkdir -p /home/devuser/.composer && \
    chown -R devuser:devuser /home/devuser /var/www/html

RUN a2enmod rewrite headers

CMD [ "apachectl", "-D", "FOREGROUND" ]
