<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Attraction;

class AttractionSeeder extends Seeder
{
    public function run(): void
    {
        $attractions = [
            [
                'name' => 'Dragon Coaster',
                'category' => 'Montagne Russe',
                'wait_time' => 25,
                'status' => 'open',
                'thrill_level' => 5,
                'min_height' => 140,
                'description' => "Un'emozionante montagna russa con loop e curve mozzafiato che ti porterà in un'avventura adrenalinica",
                'duration' => '3 min',
                'capacity' => 24,
                'rating' => 4.8,
                'location_x' => 30,
                'location_y' => 20,
                'image' => '/placeholder.svg?height=200&width=300',
                'features' => ["3 Loop", "Velocità 80 km/h", "Altezza 45m", "Foto ricordo"],
            ],
            [
                'name' => 'Splash Adventure',
                'category' => 'Acquatiche',
                'wait_time' => 15,
                'status' => 'open',
                'thrill_level' => 3,
                'min_height' => 120,
                'description' => "Avventura acquatica con cascate, rapide e un tuffo finale spettacolare",
                'duration' => '5 min',
                'capacity' => 16,
                'rating' => 4.6,
                'location_x' => 60,
                'location_y' => 40,
                'image' => '/placeholder.svg?height=200&width=300',
                'features' => ["Tuffo 15m", "Effetti acqua", "Poncho incluso", "Area splash"],
            ],
            [
                'name' => 'Magic Castle',
                'category' => 'Famiglia',
                'wait_time' => 30,
                'status' => 'open',
                'thrill_level' => 2,
                'min_height' => 100,
                'description' => "Un viaggio magico attraverso il castello incantato con personaggi fantastici",
                'duration' => '8 min',
                'capacity' => 20,
                'rating' => 4.9,
                'location_x' => 45,
                'location_y' => 60,
                'image' => '/placeholder.svg?height=200&width=300',
                'features' => ["Animatronics", "Effetti speciali", "Storia interattiva", "Per tutta la famiglia"],
            ],
            [
                'name' => 'Space Mission',
                'category' => 'Simulatori',
                'wait_time' => 0,
                'status' => 'maintenance',
                'thrill_level' => 4,
                'min_height' => 130,
                'description' => "Simulatore spaziale con effetti 4D e realtà virtuale immersiva",
                'duration' => '6 min',
                'capacity' => 12,
                'rating' => 4.7,
                'location_x' => 70,
                'location_y' => 25,
                'image' => '/placeholder.svg?height=200&width=300',
                'features' => ["Realtà virtuale", "Effetti 4D", "Simulazione NASA", "Esperienza immersiva"],
            ],
            [
                'name' => 'Fairy Tale Ride',
                'category' => 'Famiglia',
                'wait_time' => 10,
                'status' => 'open',
                'thrill_level' => 1,
                'min_height' => 80,
                'description' => "Giro tranquillo per tutta la famiglia attraverso il mondo delle fiabe",
                'duration' => '4 min',
                'capacity' => 32,
                'rating' => 4.3,
                'location_x' => 25,
                'location_y' => 45,
                'image' => '/placeholder.svg?height=200&width=300',
                'features' => ["Adatto ai bambini", "Musiche dolci", "Personaggi delle fiabe", "Giro panoramico"],
            ],
            [
                'name' => 'Thunder Mountain',
                'category' => 'Montagne Russe',
                'wait_time' => 45,
                'status' => 'open',
                'thrill_level' => 5,
                'min_height' => 140,
                'description' => "La montagna russa più veloce del parco con accelerazioni estreme",
                'duration' => '2 min',
                'capacity' => 28,
                'rating' => 4.9,
                'location_x' => 75,
                'location_y' => 65,
                'image' => '/placeholder.svg?height=200&width=300',
                'features' => ["Velocità 100 km/h", "Accelerazione 0-80 in 3s", "Inversioni multiple", "Esperienza estrema"],
            ],
            [
                'name' => 'Pirate Ship',
                'category' => 'Avventura',
                'wait_time' => 20,
                'status' => 'open',
                'thrill_level' => 3,
                'min_height' => 110,
                'description' => "Nave pirata oscillante con vista panoramica sul parco",
                'duration' => '3 min',
                'capacity' => 40,
                'rating' => 4.4,
                'location_x' => 35,
                'location_y' => 75,
                'image' => '/placeholder.svg?height=200&width=300',
                'features' => ["Vista panoramica", "Oscillazione 180°", "Tema piratesco", "Effetti sonori"],
            ],
            [
                'name' => 'VR Experience',
                'category' => 'Simulatori',
                'wait_time' => 35,
                'status' => 'open',
                'thrill_level' => 4,
                'min_height' => 125,
                'description' => "Esperienza di realtà virtuale immersiva con mondi fantastici",
                'duration' => '10 min',
                'capacity' => 8,
                'rating' => 4.8,
                'location_x' => 65,
                'location_y' => 15,
                'image' => '/placeholder.svg?height=200&width=300',
                'features' => ["VR di ultima generazione", "Mondi multipli", "Controlli gestuali", "Audio 3D"],
            ],
        ];

        foreach ($attractions as $data) {
            Attraction::updateOrCreate(
                ['name' => $data['name']], // Condizione di ricerca
                $data // Dati da inserire/aggiornare
            );
        }
    }
}
