<?php
// routes/api.php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\AttractionController;
use App\Http\Controllers\Api\LocationController;
use App\Http\Controllers\Api\TicketController;
use App\Http\Controllers\Api\ParkController;

// Rotte per autenticazione pubblica
Route::post('/auth/login', [AuthController::class, 'login']);
Route::post('/auth/register', [AuthController::class, 'register']);

// Rotte protette da autenticazione Sanctum
Route::middleware('auth:sanctum')->group(function () {
    // Auth
    Route::post('/auth/logout', [AuthController::class, 'logout']);
    Route::get('/auth/me', [AuthController::class, 'me']);
    Route::post('/auth/profile', [AuthController::class, 'updateProfile']);

    // Risorse protette
    Route::apiResource('attractions', AttractionController::class)->except(['index', 'show']);
    Route::apiResource('locations', LocationController::class)->except(['index', 'show']);
    Route::apiResource('tickets', TicketController::class)->except(['index', 'show']);

    // Se vuoi rendere anche index e show protetti, elimina "except"
});

// Rotte pubbliche (senza autenticazione)
Route::get('/attractions', [AttractionController::class, 'index']);
Route::get('/attractions/{id}', [AttractionController::class, 'show']);
Route::get('/locations', [LocationController::class, 'index']);
Route::get('/locations/{id}', [LocationController::class, 'show']);

// Eventuali endpoint pubblici separati, se servono
Route::get('/attractions/public', [AttractionController::class, 'public']);
Route::get('/locations/public', [LocationController::class, 'public']);

// Rotte per dati aggregati del parco (pubbliche)
Route::prefix('park')->group(function () {
    Route::get('/attractions', [ParkController::class, 'attractions']);
    Route::get('/shows', [ParkController::class, 'shows']);
    Route::get('/restaurants', [ParkController::class, 'restaurants']);
    Route::get('/shops', [ParkController::class, 'shops']);
    Route::get('/services', [ParkController::class, 'services']);
    Route::get('/all', [ParkController::class, 'allData']);
});

// Rotta alias per compatibilità TS
Route::get('/park-data', [ParkController::class, 'allData']);
