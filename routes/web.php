<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;

// Dashboard principale
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

// Rotte CRUD per Users
Route::post('/users', [DashboardController::class, 'storeUser'])->name('users.store');
Route::put('/users/{id}', [DashboardController::class, 'updateUser'])->name('users.update');
Route::delete('/users/{id}', [DashboardController::class, 'deleteUser'])->name('users.delete');

// Rotte CRUD per Attractions
Route::post('/attractions', [DashboardController::class, 'storeAttraction'])->name('attractions.store');
Route::put('/attractions/{id}', [DashboardController::class, 'updateAttraction'])->name('attractions.update');
Route::delete('/attractions/{id}', [DashboardController::class, 'deleteAttraction'])->name('attractions.delete');

// Aggiungere rotte simili per gli altri modelli
// ...
