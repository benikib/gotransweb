<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Vehicule;
use App\Models\Livraison;
use App\Models\Expedition;
use App\Models\Destination;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        /**Vehicule::factory(4)->create();
        Livraison::factory(4)->create();


        Expedition::factory(4)->create();
        Destination::factory(4)->create();*/

        Livraison::factory(4)->create();
    }
}
