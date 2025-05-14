<?php

use App\Http\Controllers\Api\LivraisonController;

use Illuminate\Support\Facades\Route;


Route::prefix('/livraison')->name('livraison.')->group(function () {
    
    // Liste des livraisons
    Route::get('/', [LivraisonController::class, 'index'])->name('index');
    
    // Livraisons en tant qu'expéditeur
    Route::get('/expediteur/{idClient}', [LivraisonController::class, 'getLivraisonExpediteur'])->name('expediteur');
    
    // Livraisons en tant que destinataire
    Route::get('/destinataire/{idClient}', [LivraisonController::class, 'getLivraisonDestinateur'])->name('destinataire');
    
    // Création d'une livraison
    Route::post('/store', [LivraisonController::class, 'store'])->name('store');
});


