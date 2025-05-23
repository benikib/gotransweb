<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/',[AdminController::class,'login'])->name('login');
Route::post('/',[AdminController::class,'connecter']);
Route::get('/auth/redirect/google', function ( Request $request) {
    return Socialite::driver('google')->redirect();
});





Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/views',[AdminController::class,'views'])->name('dashbord.views');
    Route::get('/dashboard', [AdminController::class,'dashboard'])->name('dashboard');
    // Importation automatique des routes depuis le dossier routeWeb
foreach (glob(__DIR__ . '/routeWeb/*.php') as $file) {
    require $file;
}
});

Route::get('/email-sent', function () {return view('auth.email-sent');})->name('password.sent');



require __DIR__.'/auth.php';


