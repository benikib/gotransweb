<?php
use App\Http\Controllers\Api\LivraisonController;




Route::prefix('livraison')->name("livraison.")->group(function () {
   Route::get('/', [LivraisonController::class, 'index'])->name('index');
});

