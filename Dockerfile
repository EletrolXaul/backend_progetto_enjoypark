FROM php:8.1-apache

# Installa dipendenze necessarie per PostgreSQL
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libpq-dev \
    zip \
    unzip \
    postgresql-client \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Installa estensioni PHP (focus su PostgreSQL)
RUN docker-php-ext-install pdo_pgsql mbstring exif pcntl bcmath gd

# Installa Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Imposta la directory di lavoro
WORKDIR /var/www/html

# Copia prima composer.json per ottimizzare la cache Docker
COPY composer.json composer.lock ./

# Installa dipendenze PHP
RUN composer install --no-dev --optimize-autoloader --no-scripts

# Copia il resto dei file dell'applicazione
COPY . /var/www/html

# Esegui gli script post-install
RUN composer run-script post-install-cmd --no-dev || true

# Crea le directory necessarie
RUN mkdir -p /var/www/html/storage/logs \
    && mkdir -p /var/www/html/storage/framework/cache \
    && mkdir -p /var/www/html/storage/framework/sessions \
    && mkdir -p /var/www/html/storage/framework/views \
    && mkdir -p /var/www/html/bootstrap/cache

# Esegui comandi Laravel per ottimizzazione
RUN php artisan config:cache || true \
    && php artisan route:cache || true \
    && php artisan view:cache || true

# Imposta i permessi
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html \
    && chmod -R 775 /var/www/html/storage \
    && chmod -R 775 /var/www/html/bootstrap/cache

# Abilita mod_rewrite per Apache
RUN a2enmod rewrite

# Configura Apache per porta dinamica di Render
RUN echo 'Listen ${PORT}' > /etc/apache2/ports.conf
RUN echo '<VirtualHost *:${PORT}>\n    ServerName localhost\n    DocumentRoot /var/www/html/public\n    <Directory /var/www/html/public>\n        AllowOverride All\n        Require all granted\n    </Directory>\n    ErrorLog ${APACHE_LOG_DIR}/error.log\n    CustomLog ${APACHE_LOG_DIR}/access.log combined\n</VirtualHost>' > /etc/apache2/sites-available/000-default.conf

# Script di avvio ottimizzato per PostgreSQL
RUN echo '#!/bin/bash\n\
set -e\n\
\n\
# Imposta la porta\n\
export PORT=${PORT:-10000}\n\
echo "Starting Laravel backend on port $PORT"\n\
echo "Frontend URL: ${FRONTEND_URL:-https://your-frontend.vercel.app}"\n\
\n\
# Test connessione PostgreSQL\n\
test_postgres_connection() {\n\
    timeout 15 php artisan migrate:status > /dev/null 2>&1\n\
}\n\
\n\
# Aspetta PostgreSQL con timeout esteso\n\
echo "Waiting for PostgreSQL connection..."\n\
counter=0\n\
max_attempts=180  # 6 minuti per PostgreSQL\n\
\n\
while ! test_postgres_connection; do\n\
    if [ $counter -ge $max_attempts ]; then\n\
        echo "PostgreSQL connection timeout after 6 minutes"\n\
        echo "Database configuration:"\n\
        echo "DB_CONNECTION: ${DB_CONNECTION:-not set}"\n\
        echo "DB_HOST: ${DB_HOST:-not set}"\n\
        echo "DB_PORT: ${DB_PORT:-not set}"\n\
        echo "DB_DATABASE: ${DB_DATABASE:-not set}"\n\
        echo "DB_USERNAME: ${DB_USERNAME:-not set}"\n\
        echo "Starting Apache without migrations..."\n\
        break\n\
    fi\n\
    echo "PostgreSQL not ready, waiting... ($counter/$max_attempts)"\n\
    sleep 2\n\
    counter=$((counter + 1))\n\
done\n\
\n\
# Esegui migrazioni se PostgreSQL è connesso\n\
if test_postgres_connection; then\n\
    echo "PostgreSQL connected successfully!"\n\
    \n\
    echo "Running migrations..."\n\
    php artisan migrate --force\n\
    \n\
    if [ $? -eq 0 ]; then\n\
        echo "Migrations completed successfully"\n\
        \n\
        echo "Running seeders..."\n\
        php artisan db:seed --force || echo "Seeder completed with warnings"\n\
        \n\
        echo "Clearing caches..."\n\
        php artisan config:clear || true\n\
        php artisan cache:clear || true\n\
    else\n\
        echo "Migration failed - check PostgreSQL configuration"\n\
    fi\n\
fi\n\
\n\
echo "Starting Apache server..."\n\
echo "Backend ready at: http://localhost:$PORT"\n\
echo "API endpoints available at: http://localhost:$PORT/api"\n\
exec apache2-foreground' > /usr/local/bin/start.sh \
    && chmod +x /usr/local/bin/start.sh

# Esponi la porta dinamica
EXPOSE ${PORT:-10000}

# Usa lo script di avvio
CMD ["/usr/local/bin/start.sh"]