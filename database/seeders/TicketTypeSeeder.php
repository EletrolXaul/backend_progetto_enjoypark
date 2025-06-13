<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TicketType;

class TicketTypeSeeder extends Seeder
{
    public function run()
    {
        $ticketTypes = [
            [
                'name' => 'Biglietto Standard',
                'type' => 'standard',
                'price' => 25.00,
                'description' => 'Accesso completo al parco per un giorno',
                'features' => [
                    'Accesso a tutte le attrazioni',
                    'Valido per un giorno',
                    'Include mappa del parco'
                ],
                'is_active' => true
            ],
            [
                'name' => 'Biglietto Famiglia',
                'type' => 'family',
                'price' => 80.00,
                'description' => 'Pacchetto famiglia (2 adulti + 2 bambini)',
                'features' => [
                    'Accesso per 4 persone',
                    'Sconto del 20%',
                    'Include pranzo per la famiglia',
                    'Accesso prioritario alle attrazioni'
                ],
                'is_active' => true
            ],
            [
                'name' => 'Biglietto Adulto',
                'type' => 'adult',
                'price' => 45.00,
                'description' => 'Biglietto per adulti con accesso completo',
                'features' => [
                    'Accesso a tutte le attrazioni',
                    'Include bevanda gratuita',
                    'Valido per un giorno'
                ],
                'is_active' => true
            ],
            [
                'name' => 'Biglietto Bambino',
                'type' => 'child',
                'price' => 35.00,
                'description' => 'Biglietto per bambini (3-12 anni)',
                'features' => [
                    'Accesso a tutte le attrazioni adatte',
                    'Include snack gratuito',
                    'Accompagnatore richiesto'
                ],
                'is_active' => true
            ],
            [
                'name' => 'Biglietto Senior',
                'type' => 'senior',
                'price' => 40.00,
                'description' => 'Biglietto per over 65 con sconto',
                'features' => [
                    'Accesso a tutte le attrazioni',
                    'Sconto del 10%',
                    'Posti a sedere riservati'
                ],
                'is_active' => true
            ]
        ];

        foreach ($ticketTypes as $ticketType) {
            TicketType::create($ticketType);
        }
    }
}