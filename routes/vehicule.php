<?php

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
