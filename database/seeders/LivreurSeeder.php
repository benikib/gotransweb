<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Livreur;

class LivreurSeeder extends Seeder
{
    public function run(): void
    {
        $photos = [
            'livreur1.jpg',
            'livreur2.jpg',
            'livreur3.jpg',
            'livreur4.jpg',
            'livreur5.jpg',
            'livreur6.jpg',
            'livreur7.jpg',
            'livreur8.jpg',
            'livreur9.jpg',
            'livreur10.jpg',
        ];

        // Les IDs des livreurs commencent à 2 car l'ID 1 est l'admin
        for ($i = 2; $i <= 11; $i++) {
            Livreur::create([
                'user_id' => $i,
                'photo' => $photos[$i - 2]
            ]);
        }
    }
}
