<?php
namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class RestaurantFactory extends Factory
{
    public function definition(): array
    {
        $categories = ['Ristorante', 'Fast Food', 'Pizzeria', 'Gelateria', 'Bar'];
        $cuisines = ['Italiana', 'Americana', 'Internazionale', 'Vegetariana', 'Dolci'];
        $priceRanges = ['$', '$$', '$$$'];
        
        return [
            'name' => $this->faker->company . ' Restaurant',
            'category' => $this->faker->randomElement($categories),
            'cuisine' => $this->faker->randomElement($cuisines),
            'price_range' => $this->faker->randomElement($priceRanges),
            'rating' => $this->faker->randomFloat(2, 3.0, 5.0),
            'description' => $this->faker->paragraph(2),
            'location_x' => $this->faker->randomFloat(6, 42.450000, 42.470000),
            'location_y' => $this->faker->randomFloat(6, 14.120000, 14.140000),
            'image' => '/images/restaurants/' . $this->faker->slug(2) . '.jpg',
            'features' => $this->faker->randomElements(['Terrazza', 'Menu bambini', 'Wifi', 'Parcheggio', 'Aria condizionata'], 3),
            'opening_hours' => $this->faker->randomElement(['09:00-21:00', '11:00-22:00', '10:00-20:00'])
        ];
    }
}