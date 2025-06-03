<?php

use App\Http\Controllers\LivreurVehiculeController;
use App\Http\Controllers\TarifController;
use App\Http\Controllers\TypeVehiculeController;
use App\Http\Controllers\VehiculeController;

use App\Models\Livreur;
use Illuminate\Support\Facades\Route;
use Mockery\Matcher\Type;

Route::get('typevehicule',  [TypeVehiculeController::class, 'index'])->name('typeVehicule.index');
Route::get('typevehicule/create',  [TypeVehiculeController::class, 'create']);
Route::post('typevehicule',  [TypeVehiculeController::class, 'store'])->name('typeVehicule.store');
Route::get('typevehicule/{type_vehicule}',  [TypeVehiculeController::class, 'edit'])->name('typeVehicule.edit');
Route::put('typevehicule/{type_vehicule}',  [TypeVehiculeController::class, 'update'])->name('typeVehicule.update');
Route::delete('typevehicule/{type_vehicule}',  [TypeVehiculeController::class, 'destroy'])->name('typeVehicule.destroy');
//      */
Route::get('tarif',  [TarifController::class, 'index'])->name('tarifs.index');
Route::get('tarif/create',  [TarifController::class, 'create']);
Route::post('tarif',  [TarifController::class, 'store'])->name('tarifs.store');
Route::get('tarif/{tarif}',  [TarifController::class, 'edit'])->name('tarifs.edit');
Route::put('tarif/{tarif}',  [TarifController::class, 'update'])->name('tarifs.update');
Route::delete('tarif/{tarif}',  [TarifController::class, 'destroy'])->name('tarifs.destroy');


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
