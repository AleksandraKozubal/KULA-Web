# For other versions check: https://hub.docker.com/_/composer/tags
FROM composer/composer:2.7.7-bin@sha256:1832641f1ba36c8e748f4b4462f77e7c8836cca7730fdf0540580d703b78f2e7 AS composer-bin

# For other versions check: https://hub.docker.com/_/node/tags?page=1&name=bullseye-slim
FROM node:22.6.0-bullseye-slim@sha256:a4b9a4773f239be06956f24fdf0b371ef87da3ad2d3eb877669254da947fa8b2 AS node

# For other versions check: https://hub.docker.com/_/php/tags?page=1&name=fpm-bullseye
FROM php:8.3.10-fpm-bullseye@sha256:857b7cdf42fc4e5b313548e6f6260fce0534439e30915824a5ac3efe9a121dff

COPY --from=composer-bin ./composer /usr/bin/composer

ARG USER_NAME=host-user
ARG USER_ID=1000
ARG PHP_FPM_GROUP=www-data

RUN adduser \
    --disabled-password \
    --uid ${USER_ID} \
    ${USER_NAME} \
    && usermod \
    --append \
    --groups \
    ${PHP_FPM_GROUP} \
    ${USER_NAME}

# Add node and npm
COPY --from=node --chown=${USER_NAME}:root /usr/local/lib/node_modules /usr/local/lib/node_modules
COPY --from=node --chown=${USER_NAME}:root /usr/local/bin/node /usr/local/bin/node
RUN ln --symbolic /usr/local/lib/node_modules/npm/bin/npm-cli.js /usr/local/bin/npm \
    && chown --no-dereference ${USER_NAME}:root /usr/local/bin/npm \
    && ln --symbolic /usr/local/lib/node_modules/npm/bin/npx-cli.js /usr/local/bin/npx \
    && chown --no-dereference ${USER_NAME}:root /usr/local/bin/npx

# Use the default development configuration
RUN mv "${PHP_INI_DIR}/php.ini-development" "${PHP_INI_DIR}/php.ini"

# For other versions check: http://nginx.org/packages/mainline/debian/pool/nginx/n/nginx/
ARG NGINX_VERSION="1.25.5-1~bullseye"
# For other versions check: https://pecl.php.net/package/redis
ARG PHPREDIS_VERSION=6.0.2

RUN apt-get update \
    && apt-get install --assume-yes gpg \
    && curl https://nginx.org/keys/nginx_signing.key | gpg --dearmour --output /etc/apt/trusted.gpg.d/apt.nginx.org.gpg > /dev/null \
    && echo "deb https://nginx.org/packages/mainline/debian bullseye nginx" | tee /etc/apt/sources.list.d/nginx.list \
    && apt-get update && apt-get install --assume-yes \
    nginx=${NGINX_VERSION} \
    libzip-dev \
    libpng-dev \
    libpq-dev \
    libicu-dev \
    supervisor \
    cron \
    git \
    && pecl install redis-${PHPREDIS_VERSION} \
    && docker-php-ext-install \
    zip \
    gd \
    pdo_pgsql \
    intl \
    bcmath \
    calendar \
    && docker-php-ext-enable \
    redis

# For other versions check: https://pecl.php.net/package/xdebug
ARG XDEBUG_VERSION=3.3.2
ARG INSTALL_XDEBUG=true

RUN if [ ${INSTALL_XDEBUG} = true ]; then \
    pecl install xdebug-${XDEBUG_VERSION} \
    && docker-php-ext-enable xdebug \
    ;fi

COPY ./entrypoint.sh /entrypoint.sh

WORKDIR /application

ENTRYPOINT ["/entrypoint.sh"]
CMD ["nodemon", "--watch", "/application", "app.js"]
