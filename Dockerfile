# Usa un'immagine Node.js per la fase di build
FROM node:18 AS build

# Imposta la directory di lavoro
WORKDIR /app

# Copia i file package.json e package-lock.json
COPY package*.json ./

# Installa le dipendenze
RUN npm install

# Copia solo i file necessari per il build
COPY resources/ resources/
COPY vite.config.js .

# Compila gli asset
RUN npm run build

# Usa l'immagine di produzione per il server
FROM richarvey/nginx-php-fpm:latest

# Copia gli asset compilati dalla fase di build
COPY --from=build /app/public/build /var/www/html/public/build

# Copia i file dell'applicazione Laravel
COPY . /var/www/html

# Crea le directory necessarie e imposta i permessi PRIMA di composer install
RUN mkdir -p /var/www/html/bootstrap/cache \
    && mkdir -p /var/www/html/storage/app \
    && mkdir -p /var/www/html/storage/framework/cache \
    && mkdir -p /var/www/html/storage/framework/sessions \
    && mkdir -p /var/www/html/storage/framework/views \
    && mkdir -p /var/www/html/storage/logs \
    && chmod -R 775 /var/www/html/storage \
    && chmod -R 775 /var/www/html/bootstrap/cache \
    && chown -R www-data:www-data /var/www/html

# Image config
ENV SKIP_COMPOSER 0
ENV WEBROOT /var/www/html/public
ENV PHP_ERRORS_STDERR 1
ENV RUN_SCRIPTS 1
ENV REAL_IP_HEADER 1

# Laravel config
ENV APP_ENV production
ENV APP_DEBUG false
ENV LOG_CHANNEL stderr

# Allow composer to run as root
ENV COMPOSER_ALLOW_SUPERUSER 1

# Installa le dipendenze PHP (ora che le directory esistono)
RUN composer install --no-dev --optimize-autoloader

CMD ["/start.sh"]