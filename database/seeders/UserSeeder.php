<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gotrans.com',
            'number_phone' => '0123456789',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
        ]);

        $livreurs = [
            [
                'name' => 'Jean Dupont',
                'email' => 'jean.dupont@gotrans.com',
                'number_phone' => '0612345678',
            ],
            [
                'name' => 'Marie Martin',
                'email' => 'marie.martin@gotrans.com',
                'number_phone' => '0623456789',
            ],
            [
                'name' => 'Pierre Durand',
                'email' => 'pierre.durand@gotrans.com',
                'number_phone' => '0634567890',
            ],
            [
                'name' => 'Sophie Leroy',
                'email' => 'sophie.leroy@gotrans.com',
                'number_phone' => '0645678901',
            ],
            [
                'name' => 'Lucas Moreau',
                'email' => 'lucas.moreau@gotrans.com',
                'number_phone' => '0656789012',
            ],
            [
                'name' => 'Emma Petit',
                'email' => 'emma.petit@gotrans.com',
                'number_phone' => '0667890123',
            ],
            [
                'name' => 'Thomas Bernard',
                'email' => 'thomas.bernard@gotrans.com',
                'number_phone' => '0678901234',
            ],
            [
                'name' => 'Julie Robert',
                'email' => 'julie.robert@gotrans.com',
                'number_phone' => '0689012345',
            ],
            [
                'name' => 'Nicolas Richard',
                'email' => 'nicolas.richard@gotrans.com',
                'number_phone' => '0690123456',
            ],
            [
                'name' => 'Laura Dubois',
                'email' => 'laura.dubois@gotrans.com',
                'number_phone' => '0601234567',
            ],
        ];

        foreach ($livreurs as $livreur) {
            User::create([
                'name' => $livreur['name'],
                'email' => $livreur['email'],
                'number_phone' => $livreur['number_phone'],
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]);
        }
    }
}
