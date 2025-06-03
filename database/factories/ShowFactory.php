<?php
namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ShowFactory extends Factory
{
    public function definition(): array
    {
        $categories = ['Avventura', 'Musical', 'Magia', 'Acrobazie', 'Bambini'];
        $venues = ['Teatro Centrale', 'Arena all\'aperto', 'Sala Piccola', 'Anfiteatro'];
        
        return [
            'name' => 'Spettacolo ' . $this->faker->words(2, true),
            'description' => $this->faker->paragraph(3),
            'venue' => $this->faker->randomElement($venues),
            'duration' => $this->faker->randomElement(['30 minuti', '45 minuti', '60 minuti']),
            'category' => $this->faker->randomElement($categories),
            'times' => $this->faker->randomElements(['10:00', '12:00', '14:00', '16:00', '18:00', '20:00'], 3),
            'capacity' => $this->faker->numberBetween(100, 500),
            'available_seats' => $this->faker->numberBetween(50, 400),
            'rating' => $this->faker->randomFloat(2, 3.5, 5.0),
            'price' => $this->faker->randomFloat(2, 5.00, 25.00),
            'age_restriction' => $this->faker->randomElement(['Tutti', '6+', '12+', '16+']),
            'location_x' => $this->faker->randomFloat(6, 42.450000, 42.470000),
            'location_y' => $this->faker->randomFloat(6, 14.120000, 14.140000),
            'image' => '/images/shows/' . $this->faker->slug(2) . '.jpg'
        ];
    }
}
