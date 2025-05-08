<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;

Route::get('/users',[UserController::class,'index'])->name('users.index');
Route::post('/users',[UserController::class,'store'])->name('users.store');
Route::get('/users/create',[UserController::class,'create'])->name('users.create');
Route::get('/users/{user}',[UserController::class,'show'])->name('users.show');     
Route::get('/users/{user}/edit',[UserController::class,'edit'])->name('users.edit');
Route::put('/users/{user}',[UserController::class,'update'])->name('users.update');
Route::delete('/users/{user}',[UserController::class,'destroy'])->name('users.destroy');