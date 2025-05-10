<?php

namespace Database\Factories;
use App\Models\Vehicule;
use App\Models\Expedition;
use App\Models\Destination;
use App\Models\User;
use App\Models\Client;



use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Livraison>
 */
class LivraisonFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {


        return [
            'date' => fake()->date(),
            'status' => fake()->randomElement(['en_attente', 'en_cours', 'livree', 'annulee']),
            'code' => fake()->lexify('???-4555-???-77'),
            'montant' => fake()->randomFloat(2, 10, 1000),
            'kilo_total' => fake()->numberBetween(10, 1000),
            'photo' => fake()->name(),
            'moyen_transport' => fake()->randomElement(['moto', 'mini_voiture', 'moyen_voiture', 'grand_voiture']),


   
            //pour les cles etranger  
            'expedition_id' => Expedition::inRandomOrder()->first()->id,
            'destination_id' => Destination::inRandomOrder()->first()->id,

            'client_expediteur_id' => fake()
            ->unique()
            ->randomElement(Client::pluck('id')->toArray()),

            'client_destinateur_id' => fake()
            ->unique()
            ->randomElement(Client::pluck('id')->toArray()),
            
            'vehicule_id' => Vehicule::inRandomOrder()->first()->id
        ];
    }
}
