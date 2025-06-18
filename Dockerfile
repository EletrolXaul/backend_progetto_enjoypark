FROM php:8.2-apache

# Installa dipendenze necessarie
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libpq-dev \
    zip \
    unzip

# Pulisce la cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Installa estensioni PHP (incluso PostgreSQL)
RUN docker-php-ext-install pdo_mysql pdo_pgsql mbstring exif pcntl bcmath gd

# Installa Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Imposta la directory di lavoro
WORKDIR /var/www/html

# Copia i file dell'applicazione
COPY . /var/www/html

# Crea le directory necessarie
RUN mkdir -p /var/www/html/storage/logs \
    && mkdir -p /var/www/html/storage/framework/cache \
    && mkdir -p /var/www/html/storage/framework/sessions \
    && mkdir -p /var/www/html/storage/framework/views \
    && mkdir -p /var/www/html/bootstrap/cache

# Installa dipendenze PHP
RUN composer install --no-dev --optimize-autoloader

# Esegui comandi Laravel per ottimizzazione
RUN php artisan config:cache \
    && php artisan route:cache \
    && php artisan view:cache

# Imposta i permessi
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html \
    && chmod -R 775 /var/www/html/storage \
    && chmod -R 775 /var/www/html/bootstrap/cache

# Abilita mod_rewrite per Apache
RUN a2enmod rewrite

# Configura Apache per Laravel
RUN echo '<VirtualHost *:80>\n\
    DocumentRoot /var/www/html/public\n\
    <Directory /var/www/html/public>\n\
        AllowOverride All\n\
    </Directory>\n\
</VirtualHost>' > /etc/apache2/sites-available/000-default.conf

# Crea script di avvio con timeout
RUN echo '#!/bin/bash\n\
set -e\n\
echo "Starting application..."\n\
\n\
# Funzione per testare la connessione al database\n\
test_db_connection() {\n\
    php artisan migrate:status > /dev/null 2>&1\n\
}\n\
\n\
# Aspetta il database con timeout di 60 secondi\n\
echo "Waiting for database connection..."\n\
counter=0\n\
max_attempts=30\n\
\n\
while ! test_db_connection; do\n\
    if [ $counter -ge $max_attempts ]; then\n\
        echo "Database connection timeout after 60 seconds"\n\
        echo "Starting Apache without migrations..."\n\
        exec apache2-foreground\n\
    fi\n\
    echo "Database not ready, waiting... ($counter/$max_attempts)"\n\
    sleep 2\n\
    counter=$((counter + 1))\n\
done\n\
\n\
echo "Database connected successfully!"\n\
\n\
# Esegui migrazioni\n\
echo "Running migrations..."\n\
if php artisan migrate --force; then\n\
    echo "Migrations completed successfully"\n\
else\n\
    echo "Migration failed, but continuing..."\n\
fi\n\
\n\
# Esegui seeder\n\
echo "Running seeders..."\n\
if php artisan db:seed --force; then\n\
    echo "Seeders completed successfully"\n\
else\n\
    echo "Seeder failed, but continuing..."\n\
fi\n\
\n\
echo "Starting Apache..."\n\
exec apache2-foreground' > /usr/local/bin/start.sh \
    && chmod +x /usr/local/bin/start.sh

# Esponi la porta 80
EXPOSE 80

# Usa lo script di avvio
CMD ["/usr/local/bin/start.sh"]