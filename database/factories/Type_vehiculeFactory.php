<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Type_vehicule>
 */
class Type_vehiculeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [


            'nom_type' => fake()->randomElement(['moto', 'mini_voiture', 'moyen_voiture', 'grand_voiture']),
            'kilo_initial' => fake()->numberBetween( 10, 1000),
            'kilo_final' => fake()->randomFloat( 10, 1000),


        ];
    }
}
