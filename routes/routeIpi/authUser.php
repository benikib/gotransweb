<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login',    [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/typeVehicule', [AuthController::class, 'getTypeVehicule']);
     Route::get('user/profile', [UserController::class, 'profile']);
    Route::put('user/profile', [UserController::class, 'updateProfile']);

    // Mot de passe
    Route::post('user/change-password', [UserController::class, 'changePassword']);

    // Photo de profil
   // Route::post('user/profile-photo', [UserController::class, 'updatePhoto']);

    // Déconnexion
    //Route::post('logout', [AuthController::class, 'logout']);
});
