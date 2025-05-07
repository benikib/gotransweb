<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Destination>
 */
class DestinationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'adresse' => fake()->randomElement(['C/mont-ngafula', 'C/limete', 'C/salongo', 'C/bandale']),
            'longitude' => fake()->randomFloat(3, 3, 5),
            'latitude' => fake()->randomFloat(3, 3, 5),
            'tel_destination' => fake()->phoneNumber(),
            
        ];
    }
}
