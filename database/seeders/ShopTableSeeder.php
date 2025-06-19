<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Shop;

class ShopTableSeeder extends Seeder
{
    public function run(): void
    {
        $shops = [
            [
                'slug' => 'main-gift-shop',
                'name' => 'Gift Shop Principale',
                'category' => 'Souvenir',
                'description' => 'Il negozio principale con la più ampia selezione di souvenir del parco',
                'location_x' => 40,
                'location_y' => 30,
                'image' => '/placeholder.svg?height=200&width=300',
                'specialties' => json_encode(["Magliette EnjoyPark", "Peluche", "Gadget", "Cartoline"]),
                'opening_hours' => '09:00 - 22:00',
            ],
            [
                'slug' => 'souvenir-shop',
                'name' => 'Negozio Souvenir',
                'category' => 'Souvenir',
                'description' => 'Souvenir esclusivi e ricordi personalizzati della tua visita',
                'location_x' => 60,
                'location_y' => 70,
                'image' => '/placeholder.svg?height=200&width=300',
                'specialties' => json_encode(["Ricordi personalizzati", "Foto stampate", "Magneti", "Portachiavi"]),
                'opening_hours' => '10:00 - 21:00',
            ],
            [
                'slug' => 'toy-store',
                'name' => 'Negozio Giocattoli',
                'category' => 'Giocattoli',
                'description' => 'Giocattoli magici e educativi per bambini di tutte le età',
                'location_x' => 35,
                'location_y' => 55,
                'image' => '/placeholder.svg?height=200&width=300',
                'specialties' => json_encode(["Giocattoli educativi", "Peluche giganti", "Puzzle", "Giochi da tavolo"]),
                'opening_hours' => '10:00 - 20:00',
            ],
            [
                'slug' => 'clothing-store',
                'name' => 'Abbigliamento EnjoyPark',
                'category' => 'Abbigliamento',
                'description' => 'Abbigliamento ufficiale e accessori del parco',
                'location_x' => 65,
                'location_y' => 30,
                'image' => '/placeholder.svg?height=200&width=300',
                'specialties' => json_encode(["Abbigliamento ufficiale", "Cappelli", "Borse", "Accessori"]),
                'opening_hours' => '09:30 - 21:30',
            ],
            [
                'slug' => 'photo-shop',
                'name' => 'Foto Ricordo',
                'category' => 'Fotografia',
                'description' => 'Stampa le tue foto delle attrazioni e crea album personalizzati',
                'location_x' => 25,
                'location_y' => 55,
                'image' => '/placeholder.svg?height=200&width=300',
                'specialties' => json_encode(["Stampa foto", "Album personalizzati", "Cornici", "Foto digitali"]),
                'opening_hours' => '10:00 - 21:00',
            ],
            [
                'slug' => 'magic-shop',
                'name' => 'Negozio di Magia',
                'category' => 'Specialità',
                'description' => 'Trucchi di magia, bacchette e oggetti misteriosi',
                'location_x' => 75,
                'location_y' => 75,
                'image' => '/placeholder.svg?height=200&width=300',
                'specialties' => json_encode(["Trucchi di magia", "Bacchette magiche", "Cristalli", "Libri di magia"]),
                'opening_hours' => '11:00 - 20:00',
            ],
        ];

        foreach ($shops as $shop) {
            Shop::updateOrCreate(
                ['slug' => $shop['slug']],
                $shop
            );
        }
    }
}
