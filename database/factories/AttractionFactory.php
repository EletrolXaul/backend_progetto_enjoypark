
<?php
namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class AttractionFactory extends Factory
{
    public function definition(): array
    {
        $categories = ['Roller Coaster', 'Famiglia', 'Acquatica', 'Bambini', 'Adrenalina'];
        $statuses = ['open', 'closed', 'maintenance'];

        return [
            'name' => $this->faker->words(3, true),
            'category' => $this->faker->randomElement($categories),
            'wait_time' => $this->faker->numberBetween(0, 60),
            'status' => $this->faker->randomElement($statuses),
            'thrill_level' => $this->faker->numberBetween(1, 5),
            'min_height' => $this->faker->randomElement([90, 100, 110, 120, 130, 140]),
            'description' => $this->faker->sentence(10),
            'duration' => $this->faker->randomElement(['1 minuto', '2 minuti', '3 minuti', '5 minuti']),
            'capacity' => $this->faker->numberBetween(12, 40),
            'rating' => $this->faker->randomFloat(2, 3.0, 5.0),
            'location_x' => $this->faker->randomFloat(6, 42.450000, 42.470000),
            'location_y' => $this->faker->randomFloat(6, 14.120000, 14.140000),
            'image' => '/images/attractions/' . $this->faker->slug(3) . '.jpg',
            'features' => $this->faker->randomElements(['Loop', 'Inversioni', 'Alta velocità', 'Splash', 'Musica', 'Effetti speciali'], 3)
        ];
    }
}
