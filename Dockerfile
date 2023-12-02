# Stage 1: Build assets using Node.js
FROM node:latest as node_builder
WORKDIR /app
COPY . .
RUN npm i
RUN npm run build

# Stage 2: composer for production
FROM composer:latest as build
WORKDIR /app
COPY --from=node_builder /app /app
RUN composer install --prefer-dist --no-dev --optimize-autoloader --no-interaction

# Stage 3: Production image
FROM php:8.1-apache-buster as production

ENV APP_ENV=production
ENV APP_DEBUG=false

RUN docker-php-ext-configure opcache --enable-opcache && \
  docker-php-ext-install pdo pdo_mysql
COPY docker/php/conf.d/opcache.ini /usr/local/etc/php/conf.d/opcache.ini

COPY --from=build /app /var/www/html
COPY docker/000-default.conf /etc/apache2/sites-available/000-default.conf
COPY .env.prod /var/www/html/.env

RUN php artisan config:cache && \
  php artisan route:cache && \
  chmod 775 -R /var/www/html/storage/ && \
  chown -R www-data:www-data /var/www/ && \
  a2enmod rewrite