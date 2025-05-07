<?php

use App\Http\Controllers\ModeleVehiculeController;
use App\Http\Controllers\TypeVehiculeController;
use Illuminate\Support\Facades\Route;
use Mockery\Matcher\Type;

Route::get('typevehicule',  [TypeVehiculeController::class, 'index'])->name('typeVehicule.index');
Route::get('typevehicule/create',  [TypeVehiculeController::class, 'create']);
Route::post('typevehicule',  [TypeVehiculeController::class, 'store'])->name('typeVehicule.store');
Route::get('typevehicule/{type_vehicule}',  [TypeVehiculeController::class, 'edit'])->name('typeVehicule.edit');
Route::post('typevehicule/{type_vehicule}',  [TypeVehiculeController::class, 'update'])->name('typeVehicule.update');
Route::delete('typevehicule/{type_vehicule}',  [TypeVehiculeController::class, 'destroy'])->name('typeVehicule.destroy');
//      */
Route::get('modelevehicule',  [ModeleVehiculeController::class, 'index'])->name('modelevehicule.index');
Route::get('modelevehicule/create',  [ModeleVehiculeController::class, 'create']);
Route::post('modelevehicule',  [ModeleVehiculeController::class, 'store'])->name('modeleVehicule.store');
Route::get('modelevehicule/{modele_vehicule}',  [ModeleVehiculeController::class, 'edit'])->name('modeleVehicule.edit');
Route::post('modelevehicule/{modele_vehicule}',  [ModeleVehiculeController::class, 'update'])->name('modeleVehicule.update');
Route::delete('modelevehicule/{modele_vehicule}',  [ModeleVehiculeController::class, 'destroy'])->name('modeleVehicule.destroy');
