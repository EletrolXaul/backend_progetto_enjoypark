<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Service;

class ServiceTableSeeder extends Seeder
{
    public function run(): void
    {
        $services = [
            [
                'slug' => 'north-parking',
                'name' => 'Parcheggio Nord',
                'category' => 'Parcheggio',
                'description' => 'Parcheggio principale con 500 posti auto',
                'location_x' => 20,
                'location_y' => 10,
                'icon' => '🚗',
                'available_24h' => true,
                'features' => json_encode(["500 posti", "Videosorveglianza", "Illuminato", "Vicino ingresso"]),
            ],
            [
                'slug' => 'south-parking',
                'name' => 'Parcheggio Sud',
                'category' => 'Parcheggio',
                'description' => 'Parcheggio secondario con navetta gratuita',
                'location_x' => 80,
                'location_y' => 80,
                'icon' => '🚗',
                'available_24h' => true,
                'features' => json_encode(["300 posti", "Navetta gratuita", "Tariffa ridotta", "Posti disabili"]),
            ],
            [
                'slug' => 'vip-parking',
                'name' => 'Parcheggio VIP',
                'category' => 'Parcheggio',
                'description' => 'Parcheggio riservato ai membri VIP',
                'location_x' => 10,
                'location_y' => 50,
                'icon' => '🌟',
                'available_24h' => true,
                'features' => json_encode(["Solo VIP", "Posti riservati", "Servizio valet", "Copertura"]),
            ],
            [
                'slug' => 'first-aid',
                'name' => 'Primo Soccorso',
                'category' => 'Medico',
                'description' => 'Centro medico con personale qualificato',
                'location_x' => 55,
                'location_y' => 35,
                'icon' => '🏥',
                'available_24h' => true,
                'features' => json_encode(["Medico presente", "Attrezzature moderne", "Pronto intervento", "Farmacia"]),
            ],
            [
                'slug' => 'info-center',
                'name' => 'Centro Informazioni',
                'category' => 'Informazioni',
                'description' => 'Punto informazioni principale del parco',
                'location_x' => 45,
                'location_y' => 45,
                'icon' => 'ℹ️',
                'available_24h' => false,
                'features' => json_encode(["Mappe gratuite", "Assistenza multilingue", "Prenotazioni", "Consigli"]),
            ],
            [
                'slug' => 'lost-found',
                'name' => 'Oggetti Smarriti',
                'category' => 'Assistenza',
                'description' => 'Centro raccolta oggetti smarriti',
                'location_x' => 35,
                'location_y' => 40,
                'icon' => '🔍',
                'available_24h' => false,
                'features' => json_encode(["Raccolta oggetti", "Sistema tracciamento", "Consegna gratuita", "Database digitale"]),
            ],
            [
                'slug' => 'main-restrooms',
                'name' => 'Servizi Igienici Principali',
                'category' => 'Servizi',
                'description' => 'Servizi igienici principali con fasciatoio',
                'location_x' => 50,
                'location_y' => 40,
                'icon' => '🚻',
                'available_24h' => true,
                'features' => json_encode(["Fasciatoio", "Accessibile", "Sempre pulito", "Carta gratuita"]),
            ],
            [
                'slug' => 'family-restrooms',
                'name' => 'Servizi Famiglia',
                'category' => 'Servizi',
                'description' => 'Servizi igienici dedicati alle famiglie',
                'location_x' => 30,
                'location_y' => 60,
                'icon' => '👨‍👩‍👧‍👦',
                'available_24h' => true,
                'features' => json_encode(["Spazio famiglie", "Fasciatoio grande", "Area gioco", "Sicurezza bambini"]),
            ],
            [
                'slug' => 'baby-care',
                'name' => 'Area Cambio Bebè',
                'category' => 'Famiglia',
                'description' => 'Area dedicata al cambio e cura dei bebè',
                'location_x' => 65,
                'location_y' => 50,
                'icon' => '🍼',
                'available_24h' => true,
                'features' => json_encode(["Fasciatoi multipli", "Scaldabiberon", "Area allattamento", "Prodotti gratuiti"]),
            ],
            [
                'slug' => 'wheelchair-rental',
                'name' => 'Noleggio Sedie a Rotelle',
                'category' => 'Accessibilità',
                'description' => 'Noleggio sedie a rotelle e ausili per disabili',
                'location_x' => 45,
                'location_y' => 35,
                'icon' => '♿',
                'available_24h' => false,
                'features' => json_encode(["Sedie a rotelle", "Ausili vari", "Noleggio gratuito", "Assistenza dedicata"]),
            ],
            [
                'slug' => 'lockers',
                'name' => 'Armadietti',
                'category' => 'Deposito',
                'description' => 'Armadietti per depositare i tuoi effetti personali',
                'location_x' => 55,
                'location_y' => 45,
                'icon' => '🔒',
                'available_24h' => true,
                'features' => json_encode(["Varie dimensioni", "Pagamento digitale", "Sicurezza garantita", "Accesso 24h"]),
            ],
            [
                'slug' => 'atm',
                'name' => 'Bancomat',
                'category' => 'Servizi Finanziari',
                'description' => 'Sportello automatico per prelievi',
                'location_x' => 40,
                'location_y' => 50,
                'icon' => '💳',
                'available_24h' => true,
                'features' => json_encode(["Prelievi", "Ricariche", "Commissioni basse", "Sempre attivo"]),
            ],
        ];

        foreach ($services as $service) {
            Service::updateOrCreate(
                ['slug' => $service['slug']],
                $service
            );
        }
    }
}
