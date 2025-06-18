# Usa un'immagine più leggera
FROM php:8.2-fpm-alpine

# Installa dipendenze essenziali
RUN apk add --no-cache nginx supervisor

# Copia i file dell'applicazione
COPY . /var/www/html
WORKDIR /var/www/html

# Installa dipendenze PHP
RUN composer install --no-dev --optimize-autoloader

# Configura permessi
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
RUN chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Copia configurazioni
COPY docker/nginx.conf /etc/nginx/nginx.conf
COPY docker/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

EXPOSE 80

CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]