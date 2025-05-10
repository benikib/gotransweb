<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LivraisonController;

Route::prefix("livraison")->name("livraison.")->group( function () {
    Route::get("/", [LivraisonController::class, "index"])->name("index");
    Route::get("/create", [LivraisonController::class, "create"])->name("create");
    Route::get("/show/{id}", [LivraisonController::class, "show"])->name("show");
    
    Route::post("/save", [LivraisonController::class, "store"])->name("store");

   

    Route::get("/edit/{id}", [LivraisonController::class, "edit"])->name("edit");
    Route::post("/update", [LivraisonController::class, "update"])->name("update");

    Route::get("/delete/{id}", [LivraisonController::class, "destroy"])->name("delete");


});