FROM php:8.3-apache

# PHP Setup
RUN apt-get update && \
    apt-get install -y \
        g++ \
        zip \
        git \
        zlib1g-dev \
        libicu-dev \
        libzip-dev \
        libonig-dev \
        libpng-dev \
        git && \
    docker-php-ext-install \
        intl \
        opcache \
        pdo \
        mysqli \
        pdo_mysql \
        mbstring \
        gd \
        zip && \
    pecl install apcu && \
    docker-php-ext-enable apcu && \
    docker-php-ext-configure zip && \
    docker-php-ext-install pcntl

# Node.js Setup
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - && \
    apt-get install -y nodejs

# Composer Setup
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# System Setup
WORKDIR /var/www/html
COPY . .

# Set the Document Root
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf && \
    sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Change Permissions
RUN if [ -d "/var/www/html/storage" ]; then chown -R www-data:www-data /var/www/html/storage; fi && \
    if [ -d "/var/www/html/bootstrap/cache" ]; then chown -R www-data:www-data /var/www/html/bootstrap/cache; fi

# Create and Set Permissions for devuser
RUN useradd -G www-data,root -u 100 -d /home/devuser devuser && \
    mkdir -p /home/devuser/.composer && \
    chown -R devuser:devuser /home/devuser /var/www/html

# Enable Apache Modules
RUN a2enmod rewrite headers

# SSL Configuration
# COPY certs/localhost.crt /etc/ssl/certs/
# COPY certs/localhost.key /etc/ssl/private/
# RUN sed -i 's|SSLCertificateFile.*|SSLCertificateFile /etc/ssl/certs/localhost.crt|g' /etc/apache2/sites-available/default-ssl.conf && \
#     sed -i 's|SSLCertificateKeyFile.*|SSLCertificateKeyFile /etc/ssl/private/localhost.key|g' /etc/apache2/sites-available/default-ssl.conf && \
#     a2ensite default-ssl

# Add Self-Signed Certificate to Trusted Authorities
# RUN cp /etc/ssl/certs/localhost.crt /usr/local/share/ca-certificates/localhost.crt && \
#     update-ca-certificates

CMD [ "apachectl", "-D", "FOREGROUND" ]
