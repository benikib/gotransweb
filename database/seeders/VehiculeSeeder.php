<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Vehicule;

class VehiculeSeeder extends Seeder
{
    public function run(): void
    {
        $vehicules = [
            [
                'type_vehicule_id' => 1,
                'modele_vehicule_id' => 1,
                'immatriculation' => 'AB-123-CD',
                'couleur' => 'Rouge'
            ],
            [
                'type_vehicule_id' => 1,
                'modele_vehicule_id' => 2,
                'immatriculation' => 'EF-456-GH',
                'couleur' => 'Bleu'
            ],
            [
                'type_vehicule_id' => 3,
                'modele_vehicule_id' => 5,
                'immatriculation' => 'IJ-789-KL',
                'couleur' => 'Noir'
            ],
            [
                'type_vehicule_id' => 4,
                'modele_vehicule_id' => 6,
                'immatriculation' => 'MN-012-OP',
                'couleur' => 'Vert'
            ],
        ];

        foreach ($vehicules as $vehicule) {
            Vehicule::create($vehicule);
        }
    }
}
