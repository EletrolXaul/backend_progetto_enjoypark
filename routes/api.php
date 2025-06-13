<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\AttractionController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\LocationController;
use App\Http\Controllers\Api\TicketController;
use App\Http\Controllers\Api\ParkController;
use App\Http\Controllers\Api\PromoCodeController;
use App\Http\Controllers\Api\PlannerController;

// Rotte per autenticazione pubblica
Route::post('/auth/login', [AuthController::class, 'login']);
Route::post('/auth/register', [AuthController::class, 'register']);

// Rotte protette da autenticazione Sanctum
Route::middleware('auth:sanctum')->group(function () {
    // Auth
    Route::post('/auth/logout', [AuthController::class, 'logout']);
    Route::get('/auth/me', [AuthController::class, 'me']);
    Route::post('/auth/profile', [AuthController::class, 'updateProfile']);

    // Risorse protette per utenti autenticati
    //Route::apiResource('orders', OrderController::class);
    //Route::apiResource('tickets', TicketController::class);
    
    // Endpoint specifico per ordini con ticket
    Route::get('tickets/orders', [OrderController::class, 'getOrdersWithTickets']);
    
    // Rotte admin protette
    Route::middleware('admin')->prefix('admin')->group(function () {
        Route::get('orders', [OrderController::class, 'adminIndex']);
        Route::get('orders', [OrderController::class, 'index']);
        Route::patch('orders/{order}/status', [OrderController::class, 'updateStatus']);
        Route::get('tickets', [TicketController::class, 'adminIndex']);
        Route::patch('tickets/{ticket}/status', [TicketController::class, 'updateStatus']);
        
        // Add these new routes:
        Route::get('users', [AuthController::class, 'getAllUsers']);
        Route::put('users/{user}/role', [AuthController::class, 'updateUserRole']);
        Route::get('promo-codes', [PromoCodeController::class, 'index']);
        Route::patch('promo-codes/{code}/status', [PromoCodeController::class, 'updateStatus']);
        
        // Aggiungi queste rotte per la gestione delle attrazioni
        Route::post('attractions', [AttractionController::class, 'store']);
        Route::put('attractions/{id}', [AttractionController::class, 'update']);
        Route::delete('attractions/{id}', [AttractionController::class, 'destroy']);
    });
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

// Rotte per le location sincronizzate
Route::prefix('locations')->group(function () {
    Route::get('/', [LocationController::class, 'index']);
    Route::get('/{id}', [LocationController::class, 'show']);
    Route::post('/sync', [LocationController::class, 'syncLocations']);
});

// Rotte per utenti autenticati
Route::middleware('auth:sanctum')->group(function () {
    // Ordini accessibili a tutti gli utenti autenticati
    Route::get('orders', [OrderController::class, 'index']);
    Route::post('orders', [OrderController::class, 'store']);
    Route::get('orders/{id}', [OrderController::class, 'show']);
    Route::get('tickets', [TicketController::class, 'index']);
    
    // Solo admin per gestione avanzata
    Route::middleware('admin')->prefix('admin')->group(function () {
        Route::patch('orders/{order}/status', [OrderController::class, 'updateStatus']);
        Route::get('users', [AuthController::class, 'getAllUsers']);
        // ... altre route admin
    });
});
