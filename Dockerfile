FROM php:8.2-apache

RUN apt-get update \
    && apt-get install -y --no-install-recommends \
        libicu-dev \
        libonig-dev \
        libzip-dev \
        unzip \
    && docker-php-ext-install \
        intl \
        mbstring \
        mysqli \
        zip \
    && a2enmod rewrite \
    && rm -rf /var/lib/apt/lists/*

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY . .

RUN composer install \
    --no-dev \
    --optimize-autoloader \
    --no-interaction \
    --no-progress

RUN sed -ri \
        's!/var/www/html!/var/www/html/public!g' \
        /etc/apache2/sites-available/000-default.conf \
    && sed -ri \
        's/AllowOverride None/AllowOverride All/g' \
        /etc/apache2/apache2.conf \
    && sed -ri \
        's/Listen 80/Listen 10000/g' \
        /etc/apache2/ports.conf \
    && sed -ri \
        's/:80>/:10000>/g' \
        /etc/apache2/sites-available/000-default.conf

RUN if ! getent group 1000 > /dev/null; then \
        groupadd -g 1000 render-secrets; \
    fi \
    && usermod -a -G 1000 www-data \
    && chown -R www-data:www-data /var/www/html/writable \
    && chmod -R 775 /var/www/html/writable

EXPOSE 10000

CMD ["apache2-foreground"]