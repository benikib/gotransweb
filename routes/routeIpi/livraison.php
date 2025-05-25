<?php

use App\Http\Controllers\Api\LivraisonController;

use Illuminate\Support\Facades\Route;



Route::prefix('livraison')->name("livraison.")->group(function () {
   
   Route::get('showLivraisonLivreur/{idLivreur}/{idLivraison}', [LivraisonController::class, 'showLivraisonLivreur'])->name('showLivraisonLivreur');
   
   Route::get('getLivraisonLivreur/{idLivreur}', [LivraisonController::class, 'getLivraisonLivreur'])->name('getLivraisonLivreur');
   Route::get('getLivraisonExpediteur/{idClient}', [LivraisonController::class, 'getLivraisonExpediteur'])->name('getLivraisonExpediteur');
   Route::get('getLivraisonDestinateur/{idClient}', [LivraisonController::class, 'getLivraisonDestinateur'])->name('getLivraisonDestinateur');
   Route::get('show/{id}', [LivraisonController::class, 'store'])->name('store');
   Route::post('/update', [LivraisonController::class, 'update'])->name('update');
   Route::post('/store', [LivraisonController::class, 'store'])->name('store');
   Route::get('/cancel/{id}', [LivraisonController::class, 'cancel'])->name('cancel');

   Route::post('/en_cours', [LivraisonController::class, 'en_cours'])->name('en_cours');

   Route::post('/terminer', [LivraisonController::class, 'terminer'])->name('terminer');

});




