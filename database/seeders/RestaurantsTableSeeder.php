<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RestaurantsTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('restaurants')->insert([
            [
                'slug' => 'central-restaurant',
                'name' => 'Ristorante Centrale',
                'category' => 'Ristorante',
                'cuisine' => 'Italiana',
                'price_range' => '$$$',
                'rating' => 4.7,
                'description' => 'Ristorante principale con cucina italiana tradizionale e vista panoramica',
                'location_x' => 50,
                'location_y' => 50,
                'image' => '/placeholder.svg?height=200&width=300',
                'features' => json_encode(["Vista panoramica", "Cucina italiana", "Menu bambini", "Terrazza"]),
                'opening_hours' => '12:00 - 22:00',
            ],
            [
                'slug' => 'pizza-corner',
                'name' => 'Pizza Corner',
                'category' => 'Fast Food',
                'cuisine' => 'Pizza',
                'price_range' => '$$',
                'rating' => 4.4,
                'description' => 'Pizzeria veloce con pizza al taglio e specialità italiane',
                'location_x' => 25,
                'location_y' => 70,
                'image' => '/placeholder.svg?height=200&width=300',
                'features' => json_encode(["Pizza al taglio", "Servizio veloce", "Asporto", "Prezzi economici"]),
                'opening_hours' => '11:00 - 21:00',
            ],
            [
                'slug' => 'burger-palace',
                'name' => 'Burger Palace',
                'category' => 'Fast Food',
                'cuisine' => 'Americana',
                'price_range' => '$$',
                'rating' => 4.3,
                'description' => 'Hamburger gourmet e specialità americane',
                'location_x' => 70,
                'location_y' => 55,
                'image' => '/placeholder.svg?height=200&width=300',
                'features' => json_encode(["Burger gourmet", "Patatine fresche", "Milkshake", "Menu vegano"]),
                'opening_hours' => '11:30 - 21:30',
            ],
            [
                'slug' => 'ice-cream-parlor',
                'name' => 'Gelateria Dolce Vita',
                'category' => 'Dolci',
                'cuisine' => 'Gelato',
                'price_range' => '$',
                'rating' => 4.8,
                'description' => 'Gelateria artigianale con gusti unici e granite',
                'location_x' => 45,
                'location_y' => 25,
                'image' => '/placeholder.svg?height=200&width=300',
                'features' => json_encode(["Gelato artigianale", "Gusti stagionali", "Granite", "Senza glutine"]),
                'opening_hours' => '10:00 - 22:00',
            ],
            [
                'slug' => 'snack-bar',
                'name' => 'Snack Bar Express',
                'category' => 'Snack',
                'cuisine' => 'Varia',
                'price_range' => '$',
                'rating' => 4.1,
                'description' => 'Snack veloci, bevande e spuntini per ogni momento',
                'location_x' => 30,
                'location_y' => 85,
                'image' => '/placeholder.svg?height=200&width=300',
                'features' => json_encode(["Servizio 24h", "Snack veloci", "Bevande fresche", "Prezzi convenienti"]),
                'opening_hours' => '24h',
            ],
            [
                'slug' => 'magic-cafe',
                'name' => 'Caffè Magico',
                'category' => 'Caffetteria',
                'cuisine' => 'Caffè',
                'price_range' => '$$',
                'rating' => 4.5,
                'description' => 'Caffetteria tematica con dolci magici e bevande speciali',
                'location_x' => 75,
                'location_y' => 35,
                'image' => '/placeholder.svg?height=200&width=300',
                'features' => json_encode(["Tema magico", "Dolci speciali", "Caffè di qualità", "Atmosfera unica"]),
                'opening_hours' => '08:00 - 20:00',
            ],
        ]);
    }
}
