FROM php:8.2-cli-bookworm AS php-base

WORKDIR /app

RUN apt-get update && apt-get install -y --no-install-recommends \
    git \
    unzip \
    libpq-dev \
    libzip-dev \
    libicu-dev \
    libpng-dev \
    libonig-dev \
    && docker-php-ext-install pdo_pgsql zip intl mbstring \
    && rm -rf /var/lib/apt/lists/*

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

FROM node:20-bookworm AS frontend

WORKDIR /app
COPY package*.json ./
RUN npm ci
COPY . .
RUN npm run build

FROM php-base AS vendor

WORKDIR /app
COPY composer.json composer.lock ./
RUN composer install \
    --no-interaction \
    --no-progress \
    --no-dev \
    --prefer-dist \
    --optimize-autoloader \
    --no-scripts

FROM php-base AS app

WORKDIR /app

COPY --from=vendor /app/vendor ./vendor
COPY . .
COPY --from=frontend /app/public/build ./public/build

RUN chmod +x render-start.sh

EXPOSE 10000

CMD ["bash", "/app/render-start.sh"]
