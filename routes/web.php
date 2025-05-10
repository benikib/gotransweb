<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;

// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/',[AdminController::class,'login'])->name('login');
Route::post('/',[AdminController::class,'connecter']);
Route::get('/views',[AdminController::class,'views'])->name('dashbord.views');
Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__.'/users.php';

require __DIR__.'/vehicule.php';

require __DIR__.'/auth.php';
