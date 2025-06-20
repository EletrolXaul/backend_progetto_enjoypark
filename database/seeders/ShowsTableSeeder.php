<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Show;

class ShowsTableSeeder extends Seeder
{
    public function run(): void
    {
        $shows = [
            [
                'slug' => 'pirate-show',
                'name' => 'Spettacolo dei Pirati',
                'description' => "Un'avventura mozzafiato con acrobazie, combattimenti e effetti speciali",
                'venue' => 'Teatro Centrale',
                'duration' => '45 min',
                'category' => 'Avventura',
                'times' => json_encode(["14:30", "17:00", "19:30"]),
                'capacity' => 200,
                'available_seats' => 45,
                'rating' => 4.8,
                'price' => 15,
                'age_restriction' => 'Tutti',
                'location_x' => 50,
                'location_y' => 50,
                'image' => '/placeholder.svg?height=200&width=300',
            ],
            [
                'slug' => 'magic-parade',
                'name' => 'Parata Magica',
                'description' => 'Una parata colorata con personaggi fantastici e musiche coinvolgenti',
                'venue' => 'Via Principale',
                'duration' => '30 min',
                'category' => 'Famiglia',
                'times' => json_encode(["16:00", "18:00"]),
                'capacity' => 500,
                'available_seats' => 120,
                'rating' => 4.9,
                'price' => 0,
                'age_restriction' => 'Tutti',
                'location_x' => 40,
                'location_y' => 30,
                'image' => '/placeholder.svg?height=200&width=300',
            ],
            [
                'slug' => 'light-show',
                'name' => 'Show delle Luci',
                'description' => 'Spettacolo notturno con giochi di luce, laser e fontane danzanti',
                'venue' => 'Piazza del Castello',
                'duration' => '25 min',
                'category' => 'Notturno',
                'times' => json_encode(["20:00", "21:30"]),
                'capacity' => 300,
                'available_seats' => 78,
                'rating' => 4.7,
                'price' => 12,
                'age_restriction' => 'Tutti',
                'location_x' => 45,
                'location_y' => 60,
                'image' => '/placeholder.svg?height=200&width=300',
            ],
            [
                'slug' => 'puppet-theater',
                'name' => 'Teatro delle Marionette',
                'description' => 'Spettacolo tradizionale con marionette per i più piccoli',
                'venue' => 'Teatro Piccolo',
                'duration' => '35 min',
                'category' => 'Bambini',
                'times' => json_encode(["15:15", "16:45"]),
                'capacity' => 80,
                'available_seats' => 12,
                'rating' => 4.6,
                'price' => 8,
                'age_restriction' => '3-12 anni',
                'location_x' => 30,
                'location_y' => 55,
                'image' => '/placeholder.svg?height=200&width=300',
            ],
            [
                'slug' => 'rock-concert',
                'name' => 'Concerto Rock',
                'description' => 'Musica dal vivo con la band del parco',
                'venue' => 'Anfiteatro',
                'duration' => '60 min',
                'category' => 'Musica',
                'times' => json_encode(["18:30"]),
                'capacity' => 400,
                'available_seats' => 89,
                'rating' => 4.5,
                'price' => 20,
                'age_restriction' => '12+',
                'location_x' => 80,
                'location_y' => 45,
                'image' => '/placeholder.svg?height=200&width=300',
            ],
            [
                'slug' => 'fairy-dance',
                'name' => 'Danza delle Fate',
                'description' => 'Spettacolo di danza con costumi elaborati e coreografie magiche',
                'venue' => 'Giardino Incantato',
                'duration' => '40 min',
                'category' => 'Danza',
                'times' => json_encode(["17:45"]),
                'capacity' => 150,
                'available_seats' => 23,
                'rating' => 4.8,
                'price' => 18,
                'age_restriction' => 'Tutti',
                'location_x' => 25,
                'location_y' => 70,
                'image' => '/placeholder.svg?height=200&width=300',
            ],
        ];

        foreach ($shows as $data) {
            Show::updateOrCreate(
                ['name' => $data['name']], // Trova per nome
                $data // Aggiorna o crea con questi dati
            );
        }
    }
}
