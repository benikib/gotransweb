<?php
use App\Http\Controllers\Api\LivraisonController;




Route::prefix('livraison')->name("livraison.")->group(function () {

   

   Route::get('getLivraisonExpediteur/{idClient}', [LivraisonController::class, 'getLivraisonExpediteur'])->name('getLivraisonExpediteur');
   Route::get('getLivraisonDestinateur/{idClient}', [LivraisonController::class, 'getLivraisonDestinateur'])->name('getLivraisonDestinateur');

   Route::post('/store', [LivraisonController::class, 'store'])->name('store');

   

});

