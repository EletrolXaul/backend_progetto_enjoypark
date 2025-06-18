# Usa PHP 8.2 con Apache
FROM php:8.2-apache

# Installa dipendenze di sistema per MySQL
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    default-mysql-client \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Installa Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copia i file dell'applicazione
COPY . /var/www/html

# Imposta la directory di lavoro
WORKDIR /var/www/html

# Imposta i permessi
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html/storage \
    && chmod -R 755 /var/www/html/bootstrap/cache

# Configura Apache per usare la porta dinamica
RUN echo 'Listen ${PORT}' > /etc/apache2/ports.conf \
    && echo '<VirtualHost *:${PORT}>' > /etc/apache2/sites-available/000-default.conf \
    && echo '    DocumentRoot /var/www/html/public' >> /etc/apache2/sites-available/000-default.conf \
    && echo '    <Directory /var/www/html/public>' >> /etc/apache2/sites-available/000-default.conf \
    && echo '        AllowOverride All' >> /etc/apache2/sites-available/000-default.conf \
    && echo '        Require all granted' >> /etc/apache2/sites-available/000-default.conf \
    && echo '    </Directory>' >> /etc/apache2/sites-available/000-default.conf \
    && echo '</VirtualHost>' >> /etc/apache2/sites-available/000-default.conf

# Abilita mod_rewrite
RUN a2enmod rewrite

# Installa le dipendenze Composer
RUN composer install --optimize-autoloader --no-dev

# Crea script di avvio migliorato per MySQL
RUN echo '#!/bin/bash' > /var/www/html/start.sh \
    && echo 'set -e' >> /var/www/html/start.sh \
    && echo 'echo "Starting Laravel application with MySQL..."' >> /var/www/html/start.sh \
    && echo 'echo "Waiting for MySQL connection..."' >> /var/www/html/start.sh \
    && echo 'MYSQL_HOST=${DB_HOST:-localhost}' >> /var/www/html/start.sh \
    && echo 'MYSQL_PORT=${DB_PORT:-3306}' >> /var/www/html/start.sh \
    && echo 'MYSQL_USER=${DB_USERNAME:-root}' >> /var/www/html/start.sh \
    && echo 'MYSQL_PASSWORD=${DB_PASSWORD}' >> /var/www/html/start.sh \
    && echo 'MYSQL_DATABASE=${DB_DATABASE}' >> /var/www/html/start.sh \
    && echo 'counter=0' >> /var/www/html/start.sh \
    && echo 'max_attempts=180' >> /var/www/html/start.sh \
    && echo 'while ! mysql -h"$MYSQL_HOST" -P"$MYSQL_PORT" -u"$MYSQL_USER" -p"$MYSQL_PASSWORD" -e "USE $MYSQL_DATABASE;" 2>/dev/null; do' >> /var/www/html/start.sh \
    && echo '  counter=$((counter + 1))' >> /var/www/html/start.sh \
    && echo '  if [ $counter -gt $max_attempts ]; then' >> /var/www/html/start.sh \
    && echo '    echo "MySQL connection timeout after $max_attempts attempts"' >> /var/www/html/start.sh \
    && echo '    exit 1' >> /var/www/html/start.sh \
    && echo '  fi' >> /var/www/html/start.sh \
    && echo '  echo "MySQL not ready, waiting... ($counter/$max_attempts)"' >> /var/www/html/start.sh \
    && echo '  sleep 2' >> /var/www/html/start.sh \
    && echo 'done' >> /var/www/html/start.sh \
    && echo 'echo "MySQL is ready!"' >> /var/www/html/start.sh \
    && echo 'echo "Running Laravel optimizations..."' >> /var/www/html/start.sh \
    && echo 'php artisan config:cache' >> /var/www/html/start.sh \
    && echo 'php artisan route:cache' >> /var/www/html/start.sh \
    && echo 'php artisan view:cache' >> /var/www/html/start.sh \
    && echo 'if mysql -h"$MYSQL_HOST" -P"$MYSQL_PORT" -u"$MYSQL_USER" -p"$MYSQL_PASSWORD" -e "USE $MYSQL_DATABASE;" 2>/dev/null; then' >> /var/www/html/start.sh \
    && echo '  echo "Running migrations..."' >> /var/www/html/start.sh \
    && echo '  php artisan migrate --force' >> /var/www/html/start.sh \
    && echo '  echo "Running seeders..."' >> /var/www/html/start.sh \
    && echo '  php artisan db:seed --force' >> /var/www/html/start.sh \
    && echo 'else' >> /var/www/html/start.sh \
    && echo '  echo "Warning: Could not connect to MySQL for migrations"' >> /var/www/html/start.sh \
    && echo 'fi' >> /var/www/html/start.sh \
    && echo 'echo "Starting Apache on port $PORT..."' >> /var/www/html/start.sh \
    && echo 'exec apache2-foreground' >> /var/www/html/start.sh \
    && chmod +x /var/www/html/start.sh

# Esponi la porta
EXPOSE $PORT

# Comando di avvio
CMD ["/var/www/html/start.sh"]