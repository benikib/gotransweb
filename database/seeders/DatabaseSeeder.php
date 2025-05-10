<?php

namespace Database\Seeders;


use App\Models\User;
use App\Models\Client;
use App\Models\Vehicule;
use App\Models\Livraison;
use App\Models\Expedition;
use App\Models\Destination;
use App\Models\Livreur;
use App\Models\Type_vehicule;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

      





           //Vehicule::factory(4)->create();


        //Expedition::factory(4)->create();

        //Destination::factory(4)->create();


         //User::factory(10)->create();

         //Client::factory(10)->create();

      //Type_vehicule::factory(10)->create();

        Livraison::factory(4)->create();







    }
}
