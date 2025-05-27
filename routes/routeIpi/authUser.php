<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\Auth\ForgotPasswordController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login',    [AuthController::class, 'login']);
//Route::get('/auth/redirect/google', [GoogleAuthController::class, 'redirectToGoogle']);
//Route::get('/auth/callback/google', [GoogleAuthController::class, 'handleGoogleCallback']);
// routes/api.php
Route::post('/auth/google', [GoogleAuthController::class, '__invoke']);


Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLink']);
Route::post('/reset-password', [ForgotPasswordController::class, 'resetPassword']);
// routes/api.php
Route::post('auth/google', [AuthController::class, 'handleGoogleLogin']);

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
