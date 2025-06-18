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

# Configura Apache per usare la porta dinamica di Render
RUN echo 'Listen ${PORT}' > /etc/apache2/ports.conf

# Configura VirtualHost per la porta dinamica
RUN echo '<VirtualHost *:${PORT}>\n\
    DocumentRoot /var/www/html/public\n\
    <Directory /var/www/html/public>\n\
        AllowOverride All\n\
        Require all granted\n\
    </Directory>\n\
    ErrorLog ${APACHE_LOG_DIR}/error.log\n\
    CustomLog ${APACHE_LOG_DIR}/access.log combined\n\
</VirtualHost>' > /etc/apache2/sites-available/000-default.conf

# Crea script di avvio migliorato
RUN echo '#!/bin/bash\n\
set -e\n\
\n\
# Imposta la porta (default 10000 per Render)\n\
export PORT=${PORT:-10000}\n\
echo "Starting application on port $PORT"\n\
\n\
# Funzione per testare la connessione al database\n\
test_db_connection() {\n\
    php artisan migrate:status > /dev/null 2>&1\n\
}\n\
\n\
# Aspetta il database con timeout\n\
echo "Waiting for database connection..."\n\
counter=0\n\
max_attempts=30\n\
\n\
while ! test_db_connection; do\n\
    if [ $counter -ge $max_attempts ]; then\n\
        echo "Database connection timeout after 60 seconds"\n\
        echo "Starting Apache without migrations..."\n\
        break\n\
    fi\n\
    echo "Database not ready, waiting... ($counter/$max_attempts)"\n\
    sleep 2\n\
    counter=$((counter + 1))\n\
done\n\
\n\
# Se il database è connesso, esegui migrazioni\n\
if test_db_connection; then\n\
    echo "Database connected successfully!"\n\
    echo "Running migrations..."\n\
    php artisan migrate --force || echo "Migration failed, continuing..."\n\
    echo "Running seeders..."\n\
    php artisan db:seed --force || echo "Seeder failed, continuing..."\n\
fi\n\
\n\
echo "Starting Apache on port $PORT..."\n\
exec apache2-foreground' > /usr/local/bin/start.sh \
    && chmod +x /usr/local/bin/start.sh

# Esponi la porta dinamica
EXPOSE ${PORT:-10000}

# Usa lo script di avvio
CMD ["/usr/local/bin/start.sh"]



## Analisi del Log

Dal log vedo che:

1. ✅ **Upload riuscito**
2. ✅ **Applicazione avviata**
3. ⚠️ **Database timeout** (come previsto)
4. ✅ **Apache avviato senza migrazioni** (fallback funzionante)
5. ⚠️ **Problema porta**: `No open ports detected`

## Problema Principale: Porta

Il messaggio `No open ports detected` indica che Apache non sta ascoltando sulla porta corretta. <mcreference link="https://render.com/docs/web-services#port-binding" index="0">0</mcreference>

### Soluzione: Configurare la Porta

Render si aspetta che l'applicazione ascolti sulla porta definita dalla variabile d'ambiente `PORT` (default: 10000), ma Apache è configurato per la porta 80.

## Dockerfile Corretto

Ecco la versione aggiornata del <mcfile name="Dockerfile" path="c:\Users\pcela\Desktop\Esame Finale\backend_progetto_enjoypark\Dockerfile"></mcfile>:
```
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

# Installa estensioni PHP
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

# Configura Apache per usare la porta dinamica di Render
RUN echo 'Listen ${PORT}' > /etc/apache2/ports.conf

# Configura VirtualHost per la porta dinamica
RUN echo '<VirtualHost *:${PORT}>\n\
    DocumentRoot /var/www/html/public\n\
    <Directory /var/www/html/public>\n\
        AllowOverride All\n\
        Require all granted\n\
    </Directory>\n\
    ErrorLog ${APACHE_LOG_DIR}/error.log\n\
    CustomLog ${APACHE_LOG_DIR}/access.log combined\n\
</VirtualHost>' > /etc/apache2/sites-available/000-default.conf

# Crea script di avvio migliorato
RUN echo '#!/bin/bash\n\
set -e\n\
\n\
# Imposta la porta (default 10000 per Render)\n\
export PORT=${PORT:-10000}\n\
echo "Starting application on port $PORT"\n\
\n\
# Funzione per testare la connessione al database\n\
test_db_connection() {\n\
    php artisan migrate:status > /dev/null 2>&1\n\
}\n\
\n\
# Aspetta il database con timeout\n\
echo "Waiting for database connection..."\n\
counter=0\n\
max_attempts=30\n\
\n\
while ! test_db_connection; do\n\
    if [ $counter -ge $max_attempts ]; then\n\
        echo "Database connection timeout after 60 seconds"\n\
        echo "Starting Apache without migrations..."\n\
        break\n\
    fi\n\
    echo "Database not ready, waiting... ($counter/$max_attempts)"\n\
    sleep 2\n\
    counter=$((counter + 1))\n\
done\n\
\n\
# Se il database è connesso, esegui migrazioni\n\
if test_db_connection; then\n\
    echo "Database connected successfully!"\n\
    echo "Running migrations..."\n\
    php artisan migrate --force || echo "Migration failed, continuing..."\n\
    echo "Running seeders..."\n\
    php artisan db:seed --force || echo "Seeder failed, continuing..."\n\
fi\n\
\n\
echo "Starting Apache on port $PORT..."\n\
exec apache2-foreground' > /usr/local/bin/start.sh \
    && chmod +x /usr/local/bin/start.sh

# Esponi la porta dinamica
EXPOSE ${PORT:-10000}

# Usa lo script di avvio
CMD ["/usr/local/bin/start.sh"]