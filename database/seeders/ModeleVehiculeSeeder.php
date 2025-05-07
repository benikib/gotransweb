<?php

namespace Database\Seeders;

use App\Models\Modele_vehicule;
use Illuminate\Database\Seeder;
use App\Models\ModeleVehicule;

class ModeleVehiculeSeeder extends Seeder
{
    public function run(): void
    {
        $modeles = [
            ['nom_modele' => 'Renault Clio', 'tarif' => 50.00],
            ['nom_modele' => 'Peugeot 208', 'tarif' => 55.00],
            ['nom_modele' => 'Citroën C3', 'tarif' => 52.50],
            ['nom_modele' => 'Toyota Yaris', 'tarif' => 48.00],
            ['nom_modele' => 'Honda CBR 600', 'tarif' => 45.00],
            ['nom_modele' => 'Vélo électrique', 'tarif' => 30.00],
        ];

        foreach ($modeles as $modele) {
            Modele_vehicule::create($modele);
        }
    }
}
