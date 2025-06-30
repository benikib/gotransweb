<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\File;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Pour éviter les erreurs de longueur de chaîne sur d'anciennes versions de MySQL
        Schema::defaultStringLength(191);

        // Personnalisation de l'URL de reset de mot de passe
        ResetPassword::createUrlUsing(function ($notifiable, string $token) {
            return url("/reset-password/{$token}?email=" . urlencode($notifiable->getEmailForPasswordReset()));
        });

        // --- COPIE MANUELLE SI PAS DE SYMLINK ---
        // Si le répertoire public/storage n'existe pas, on copie le contenu
        $publicStorage = public_path('storage');
        $appStorage    = storage_path('app/public');

        if (! File::exists($publicStorage)) {
            // Crée le dossier public/storage s’il n’existe pas
            File::makeDirectory($publicStorage, 0755, true);

            // Copie tous les fichiers de storage/app/public vers public/storage
            File::copyDirectory($appStorage, $publicStorage);
        }
    }
}
