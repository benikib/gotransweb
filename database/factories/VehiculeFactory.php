<?php

namespace Database\Factories;
use App\Models\Type_vehicule;

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

            'type_vehicule_id' => Type_vehicule::inRandomOrder()->first()->id,
          
            'immatriculation' => fake()->lexify('???-444-???'),
            'etat' => true,
            'couleur' =>  fake()->randomElement(['rouge', 'bleu', 'vert', 'noir', 'blanc']),
            
        ];
    }
}
