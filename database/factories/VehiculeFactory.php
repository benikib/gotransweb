<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vehicule>
 */
class VehiculeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [

            'type_vehicule_id' => fake()->numberBetween(1, 20),
            'modele_vehicule_id' => fake()->numberBetween(1, 20),
            'immatriculation' => fake()->lexify('???-444-???'),
            'couleur' =>  fake()->randomElement(['rouge', 'bleu', 'vert', 'noir', 'blanc']),
            
        ];
    }
}
