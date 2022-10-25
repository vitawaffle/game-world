FROM php:8.1-fpm-alpine
RUN apk update && apk upgrade \
    && apk add bash nano less git tzdata icu-dev libpq-dev \
    && cp /usr/share/zoneinfo/Europe/Minsk /etc/localtime \
    && echo "Europe/Minsk" > /etc/timezone \
    && apk del tzdata \
    && curl -1sLf 'https://dl.cloudsmith.io/public/symfony/stable/setup.alpine.sh' | bash \
    && apk add symfony-cli \
    && git config --global user.email "vitaly.lobatsevich@gmail.com" \
    && git config --global user.name "Vitaly Lobatsevich" \
    && docker-php-ext-install intl opcache pdo_pgsql
COPY ./composer.phar /usr/local/bin/composer
EXPOSE 9000
