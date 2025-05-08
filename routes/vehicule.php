<?php

use App\Http\Controllers\LivreurVehiculeController;
use App\Http\Controllers\ModeleVehiculeController;
use App\Http\Controllers\TypeVehiculeController;
use App\Http\Controllers\VehiculeController;
use App\Models\Livreur;
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


Route::get('vehicule',  [VehiculeController::class, 'index'])->name('vehicule.index');
Route::get('vehicule/create',  [VehiculeController::class, 'create']);
Route::post('vehicule',  [VehiculeController::class, 'store'])->name('vehicule.store');
Route::get('vehicule/{vehicule}',  [VehiculeController::class, 'edit'])->name('vehicule.edit');
Route::post('vehicule/{vehicule}',  [VehiculeController::class, 'update'])->name('vehicule.update');
Route::delete('vehicule/{vehicule}',  [VehiculeController::class, 'destroy'])->name('vehicule.destroy');
Route::get('vehicule/{vehicule}/show',  [VehiculeController::class, 'show'])->name('vehicule.show');


Route::get('affectation',  [LivreurVehiculeController::class, 'index'])->name('livreurVehicule.index');
Route::get('affectation/create',  [LivreurVehiculeController::class, 'create']);
Route::post('affectation',  [LivreurVehiculeController::class, 'store'])->name('livreurVehicule.store');
Route::get('affectation/{livreur_Vehicule}',  [LivreurVehiculeController::class, 'edit'])->name('livreurVehicule.edit');
Route::post('affectation/{livreur_Vehicule}',  [LivreurVehiculeController::class, 'update'])->name('livreurVehicule.update');
Route::delete('affectation/{livreur_Vehicule}',  [LivreurVehiculeController::class, 'destroy'])->name('livreurVehicule.destroy');
Route::get('affectation/{livreur_Vehicule}/show',  [LivreurVehiculeController::class, 'show'])->name('livreurVehicule.show');