<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;

Route::get('/user', [UserController::class, 'index']);




foreach (glob(__DIR__ . '/routeIpi/*.php') as $file) {
    require $file;
}