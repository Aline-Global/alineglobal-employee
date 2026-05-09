FROM dunglas/frankenphp:php8.3-bookworm AS base

RUN apt-get update \
    && apt-get install -y --no-install-recommends git unzip libpq-dev \
    && rm -rf /var/lib/apt/lists/*

RUN install-php-extensions exif intl pcntl bcmath gd pdo_pgsql zip fileinfo imagick

WORKDIR /app

FROM base AS vendor
WORKDIR /app

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer
COPY composer.json composer.lock ./
RUN composer install \
    --no-dev \
    --prefer-dist \
    --optimize-autoloader \
    --no-interaction \
    --no-scripts

FROM node:22-bookworm-slim AS assets
WORKDIR /app

COPY package.json package-lock.json ./
RUN npm ci

COPY resources ./resources
COPY public ./public
COPY vite.config.js ./
RUN npm run build && npm prune --omit=dev --ignore-scripts

FROM base AS app
WORKDIR /app

COPY . .
COPY --from=vendor /app/vendor ./vendor
COPY --from=assets /app/public ./public

RUN rm -rf node_modules \
    && mkdir -p storage/framework/cache storage/framework/sessions storage/framework/views bootstrap/cache \
    && chown -R www-data:www-data storage bootstrap/cache

ENV APP_ENV=production
ENV APP_DEBUG=false

EXPOSE 8080

CMD ["sh", "-c", "mkdir -p storage/app/public storage/app/private storage/framework/livewire-tmp && php artisan storage:link || true && php artisan migrate --force && php artisan optimize && php artisan filament:assets && php artisan serve --host=0.0.0.0 --port=${PORT:-8080}"]
