<?php

use App\Http\Controllers\Api\LocalisationsController;

use Illuminate\Support\Facades\Route;



Route::prefix('localisation')->name("localisation.")->group(function () {
   
   Route::post('/setLocalisation', [LocalisationsController::class, 'update'])->name('update');

   Route::post('/getLocalisation', [LocalisationsController::class, 'show'])->name('show');

});