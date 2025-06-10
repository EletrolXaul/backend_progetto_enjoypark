## 📄 README Backend (Laravel)

**File:** `README.md` per la cartella 
`backend_progetto_enjoypark`
# 📄 README Backend (Laravel)
**File:** `README.md` per la cartella
`backend_progetto_enjoypark` 
 
```markdown
# 🎢 EnjoyPark - Backend API

API REST completa per la gestione di un parco 
divertimenti costruita con Laravel. Fornisce 
tutti i servizi backend per autenticazione, 
gestione biglietti, ordini, e dati del parco.

## 🚀 Caratteristiche Principali

### 🔐 Autenticazione & Autorizzazione
- **Laravel Sanctum** per autenticazione API
- **Spatie Permissions** per gestione ruoli e 
permessi
- **Middleware di protezione** per rotte 
sensibili
- **Rate limiting** per sicurezza API

### 🎫 Sistema Biglietteria
- **Gestione Ordini** completa con stati
- **Generazione QR Code** univoci per biglietti
- **Sistema Promozionale** con codici sconto
- **Validazione Pagamenti** simulati
- **Cronologia Acquisti** utenti

### 🏰 Gestione Parco
- **Attrazioni** con categorie e tempi di attesa
- **Spettacoli** programmati con orari
- **Ristoranti** con menu e prezzi
- **Negozi** con prodotti e categorie
- **Servizi** del parco (bagni, info, ecc.)
- **Locations** con coordinate GPS

### 📊 Dashboard Amministrativo
- **Statistiche** vendite e utilizzo
- **Gestione Contenuti** del parco
- **Monitoraggio Ordini** in tempo reale
- **Analytics** dettagliate

## 🛠️ Stack Tecnologico

### Core Framework
- **Laravel 12** (PHP 8.2+)
- **MySQL/PostgreSQL** database
- **Redis** per caching e sessioni

### Autenticazione & Sicurezza
- **Laravel Sanctum** per API tokens
- **Spatie Laravel Permission** per ACL
- **CORS** configurato per frontend

### Sviluppo & Testing
- **Pest PHP** per testing
- **Laravel Pint** per code styling
- **Faker** per dati di test
- **Laravel Tinker** per debugging

### Frontend Assets (Opzionale)
- **Vite** per build assets
- **Tailwind CSS** per admin panel
- **Alpine.js** per interattività

## 📋 Prerequisiti

- **PHP** 8.2 o superiore
- **Composer** 2.0+
- **MySQL** 8.0+ o **PostgreSQL** 13+
- **Redis** 6.0+ (opzionale ma raccomandato)
- **Node.js** 18+ (per assets frontend)

### Estensioni PHP Richieste

```bash
php-curl
php-dom
php-fileinfo
php-filter
php-hash
php-mbstring
php-openssl
php-pcre
php-pdo
php-session
php-tokenizer
php-xml

```

## 🚀 Installazione e Setup

### 1. Clona il Repository

```bash
git clone [repository-url]
cd backend_progetto_enjoypark
```

### 2. Installa le Dipendenze

```bash
composer install
npm install
```

### 3. Configura l'Ambiente

```bash
cp .env.example .env
php artisan key:generate
```

Modifica .env con le tue configurazioni:

```bash
APP_NAME=EnjoyPark
APP_ENV=local
APP_KEY=base64:...
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=enjoypark
DB_USERNAME=root
DB_PASSWORD=

REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

SANCTUM_STATEFUL_DOMAINS=localhost:3000
SESSION_DOMAIN=localhost
```

### 4. Setup Database


# Crea il database
```bash
mysql -u root -p -e "CREATE DATABASE enjoypark;"
```
# Esegui le migrazioni
```bash
php artisan migrate
```
# Popola il database con dati di esempio
```bash
php artisan db:seed
```

### 5. Configura Storage

```bash
php artisan storage:link
```

### 6. Avvia il Server

```bash
php artisan serve
# Server disponibile su http://localhost:8000
```

### 7. Build Assets (Opzionale)

```bash
npm run dev
```
# oppure per produzione
```bash
npm run build
```

## 🗄️ Struttura Database

### Tabelle Principali Users

-   Gestione utenti e amministratori
-   Campi: id, name, email, password, role Attractions
-   Attrazioni del parco
-   Campi: id, name, category, thrill_level, wait_time, status Shows
-   Spettacoli programmati
-   Campi: id, name, category, duration, times, capacity Restaurants
-   Ristoranti e punti ristoro
-   Campi: id, name, cuisine, price_range, rating, menu Shops
-   Negozi e souvenir
-   Campi: id, name, category, products, opening_hours Services
-   Servizi del parco
-   Campi: id, name, type, location, availability Orders
-   Ordini e biglietti
-   Campi: id, user_id, order_number, tickets, total_price, status Locations
-   Posizioni geografiche
-   Campi: id, name, category, latitude, longitude, metadata

## 🔌 API Endpoints

### Autenticazione

```bash
POST   /api/auth/register     # Registrazione 
utente
POST   /api/auth/login        # Login utente
POST   /api/auth/logout       # Logout (protetto)
GET    /api/auth/user         # Dati utente 
corrente (protetto)
```

### Parco (Pubbliche)

```bash
GET    /api/park/attractions  # Lista attrazioni
GET    /api/park/shows        # Lista spettacoli
GET    /api/park/restaurants  # Lista ristoranti
GET    /api/park/shops        # Lista negozi
GET    /api/park/services     # Lista servizi
GET    /api/park/all-data     # Tutti i dati del 
parco
```

### Gestione Contenuti (Protette)

```bash
GET    /api/attractions       # Lista attrazioni 
(admin)
POST   /api/attractions       # Crea attrazione
PUT    /api/attractions/{id}  # Aggiorna 
attrazione
DELETE /api/attractions/{id}  # Elimina 
attrazione
```
# Stessi pattern per shows, restaurants, shops, 
services
```

### Ordini (Protette)

```bash
GET    /api/orders           # Lista ordini 
utente
POST   /api/orders           # Crea nuovo ordine
GET    /api/orders/{id}      # Dettagli ordine
PUT    /api/orders/{id}      # Aggiorna ordine
```

### Locations

```bash
GET    /api/locations        # Lista locations
POST   /api/locations        # Crea location 
(admin)
```

## 🧪 Testing

### Esegui i Test

```
# Tutti i test
```bash
php artisan test
```
# Test specifici
```bash
php artisan test --filter=AuthTest
php artisan test tests/Feature/OrderTest.php
```
# Con coverage
```bash
php artisan test --coverage
```

### Dati di Test

```
# Reset database con dati freschi
```bash
php artisan migrate:fresh --seed
```

# Solo seeders
```bash
php artisan db:seed
```

# Seeder specifico
```bash
php artisan db:seed --class=AttractionSeeder
```

## 🔧 Comandi Artisan Personalizzati

### Sincronizzazione Locations

```bash
# Sincronizza locations con dati del parco
php artisan locations:sync

# Con pulizia precedente
php artisan locations:sync --clean
```

### Gestione Cache

```bash
# Pulisci tutte le cache
php artisan optimize:clear

# Ottimizza per produzione
php artisan optimize
```

## 📊 Monitoraggio e Logging

### Log Files

```bash
storage/logs/laravel.log     # Log applicazione
storage/logs/api.log         # Log API requests
storage/logs/auth.log        # Log autenticazione
```

### Monitoring

```bash
# Monitora log in tempo reale
php artisan pail

# Statistiche performance
php artisan route:list
php artisan model:show User
```

## 🚀 Deploy in Produzione

### Preparazione

```bash
# Ottimizza per produzione
composer install --optimize-autoloader --no-dev
php artisan config:cache
php artisan route:cache
php artisan view:cache
npm run build
```

### Configurazione Server Nginx

```bash
server {
    listen 80;
    server_name api.enjoypark.com;
    root /var/www/enjoypark/public;

    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-Content-Type-Options "nosniff";

    index index.php;

    charset utf-8;

    location / {
        try_files $uri $uri/ /index.php?
        $query_string;
    }

    location = /favicon.ico { access_log off; 
    log_not_found off; }
    location = /robots.txt  { access_log off; 
    log_not_found off; }

    error_page 404 /index.php;

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.
        2-fpm.sock;
        fastcgi_param SCRIPT_FILENAME 
        $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }
}
```

### Variabili Ambiente Produzione

```bash
APP_ENV=production
APP_DEBUG=false
APP_URL=https://api.enjoypark.com

DB_CONNECTION=mysql
DB_HOST=your-db-host
DB_DATABASE=enjoypark_prod
DB_USERNAME=your-db-user
DB_PASSWORD=your-secure-password

REDIS_HOST=your-redis-host
REDIS_PASSWORD=your-redis-password

MAIL_MAILER=smtp
MAIL_HOST=your-smtp-host
MAIL_PORT=587
MAIL_USERNAME=your-email
MAIL_PASSWORD=your-email-password
```

## 🔒 Sicurezza

### Best Practices Implementate

-   CSRF Protection su tutte le rotte web
-   Rate Limiting su API endpoints
-   SQL Injection Prevention via Eloquent ORM
-   XSS Protection con escape automatico
-   CORS configurato correttamente
-   Sanctum Tokens per autenticazione API

### Configurazione Sicurezza

```bash
// config/cors.php
'allowed_origins' => ['http://localhost:3000'],
'allowed_methods' => ['GET', 'POST', 'PUT', 
'DELETE'],
'allowed_headers' => ['*'],
'supports_credentials' => true,
```

## 🐛 Troubleshooting

### Problemi Comuni

Errore 500 - Internal Server Error

```bash
# Controlla i log
tail -f storage/logs/laravel.log

# Verifica permessi
chmod -R 755 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/
cache
```

Errori Database

```bash
# Verifica connessione
php artisan tinker
>>> DB::connection()->getPdo();

# Reset migrazioni
php artisan migrate:fresh --seed
```

Problemi CORS

```bash
# Pulisci cache configurazione
php artisan config:clear

# Verifica configurazione CORS
php artisan config:show cors
```

Performance Issues

```bash
# Abilita query log
php artisan tinker
>>> DB::enableQueryLog();
>>> // esegui operazioni
>>> DB::getQueryLog();
```

## 📈 Performance Optimization

### Caching

```bash
# Cache configurazione
php artisan config:cache

# Cache rotte
php artisan route:cache

# Cache views
php artisan view:cache

# Ottimizza autoloader
composer dump-autoload --optimize
```

### Database Optimization

```bash
-- Indici per performance
CREATE INDEX idx_orders_user_id ON orders
(user_id);
CREATE INDEX idx_orders_status ON orders(status);
CREATE INDEX idx_attractions_category ON 
attractions(category);
```

## 🤝 Contribuire

### Setup Sviluppo

```bash
# Installa dipendenze dev
composer install
npm install

# Setup pre-commit hooks
composer run post-install-cmd

# Esegui test prima di commit
php artisan test
php artisan pint
```

### Linee Guida

1. PSR-12 per coding standards
2. Test Coverage minimo 80%
3. Documentazione per nuove API
4. Migration per modifiche database
5. Seeder per dati di esempio

## 📄 Licenza

Questo progetto è sotto licenza MIT. Vedi LICENSE per dettagli.

## 📞 Supporto

Per supporto tecnico:

-   📧 Email: dev@enjoypark.it
-   💬 Issues: GitHub Issues
-   📖 Docs: API Documentation
    Sviluppato con ❤️ per EnjoyPark Backend Team
