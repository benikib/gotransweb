<?php

namespace Database\Seeders;

use App\Models\Type_vehicule;
use Illuminate\Database\Seeder;
use App\Models\TypeVehicule;

class TypeVehiculeSeeder extends Seeder
{
    public function run(): void
    {
        $types = [
            ['nom_type' => 'Voiture'],
            ['nom_type' => 'Camion'],
            ['nom_type' => 'Moto'],
            ['nom_type' => 'Vélo'],
        ];

        foreach ($types as $type) {
            Type_vehicule::create($type);
        }
    }
}
