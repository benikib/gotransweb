<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;

class PurgeDBConnections extends Command
{
    // Signature de la commande artisan
    protected $signature = 'db:purge-connections';

    // Description de la commande
    protected $description = 'Purge toutes les connexions actives à la base de données';

    // Méthode appelée lors de l'exécution de la commande
    public function handle()
    {
        // Récupère toutes les connexions définies dans config/database.php
        $connections = array_keys(Config::get('database.connections'));

        // Parcours chaque connexion et la purge
        foreach ($connections as $connection) {
            DB::purge($connection);
            $this->info("Connexion '$connection' purgée avec succès.");
        }

        $this->info("✅ Toutes les connexions ont été purgées.");
        return 0;
    }
}
