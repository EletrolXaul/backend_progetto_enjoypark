<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\TicketController;
use App\Http\Controllers\Api\PlannerController;
use App\Http\Controllers\Api\PromoCodeController;
use App\Http\Controllers\Api\TicketTypeController; // Add this line
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AttractionController;
use App\Http\Controllers\Api\ParkController;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ShowController;
use App\Http\Controllers\MockCreditCardController;
use App\Http\Controllers\VisitHistoryController;

// Rotte per autenticazione pubblica
Route::post('/auth/login', [AuthController::class, 'login']);
Route::post('/auth/register', [AuthController::class, 'register']);

// Rotte protette da autenticazione Sanctum
Route::middleware('auth:sanctum')->group(function () {
    // Auth
    Route::post('/auth/logout', [AuthController::class, 'logout']);
    Route::get('/auth/me', [AuthController::class, 'me']);
    Route::post('/auth/profile', [AuthController::class, 'updateProfile']);

    // Endpoint specifico per ordini con ticket
    Route::get('tickets/orders', [OrderController::class, 'getOrdersWithTickets']);

    // Rotte admin protette
    Route::middleware('admin')->prefix('admin')->group(function () {
        // Statistiche admin
        Route::get('stats', [DashboardController::class, 'getStats']);

        // Gestione utenti
        Route::get('users', [AuthController::class, 'getAllUsers']);
        Route::post('users', [AuthController::class, 'createUser']);
        Route::put('users/{user}', [AuthController::class, 'updateUser']);
        Route::delete('users/{user}', [AuthController::class, 'deleteUser']);

        // Gestione tipi di biglietto
        Route::get('ticket-types', [App\Http\Controllers\Api\TicketTypeController::class, 'index']);
        Route::post('ticket-types', [App\Http\Controllers\Api\TicketTypeController::class, 'store']);
        Route::get('ticket-types/{id}', [App\Http\Controllers\Api\TicketTypeController::class, 'show']);
        Route::put('ticket-types/{id}', [App\Http\Controllers\Api\TicketTypeController::class, 'update']);
        Route::delete('ticket-types/{id}', [App\Http\Controllers\Api\TicketTypeController::class, 'destroy']);

        // Gestione planner (admin view)
        Route::get('planner-items', [PlannerController::class, 'adminIndex']);

        // Gestione spettacoli
        Route::get('shows', [ShowController::class, 'adminIndex']);
        Route::post('shows', [ShowController::class, 'store']);
        Route::put('shows/{show}', [ShowController::class, 'update']);
        Route::delete('shows/{show}', [ShowController::class, 'destroy']);

        // Gestione attrazioni
        Route::get('attractions', [AttractionController::class, 'adminIndex']);
        Route::post('attractions', [AttractionController::class, 'store']);
        Route::put('attractions/{attraction}', [AttractionController::class, 'update']);
        Route::delete('attractions/{attraction}', [AttractionController::class, 'destroy']);

        // Gestione codici promozionali
        Route::get('promo-codes', [PromoCodeController::class, 'adminIndex']);
        Route::post('promo-codes', [PromoCodeController::class, 'store']);
        Route::put('promo-codes/{promoCode}', [PromoCodeController::class, 'update']);
        Route::delete('promo-codes/{promoCode}', [PromoCodeController::class, 'destroy']);

        // Gestione carte di credito
        Route::get('credit-cards', [MockCreditCardController::class, 'adminIndex']);
        Route::put('credit-cards/{card}/block', [MockCreditCardController::class, 'block']);
        Route::put('credit-cards/{card}/unblock', [MockCreditCardController::class, 'unblock']);
        Route::delete('credit-cards/{card}', [MockCreditCardController::class, 'destroy']);

        // Gestione storico visite
        Route::get('visit-history', [VisitHistoryController::class, 'adminIndex']);
        Route::get('visit-history/export', [VisitHistoryController::class, 'export']);

        // Gestione ordini e biglietti (già esistenti, ma da verificare)
        Route::get('orders', [OrderController::class, 'adminIndex']);
        Route::put('orders/{order}', [OrderController::class, 'update']);
        Route::delete('orders/{order}', [OrderController::class, 'destroy']);

        Route::get('tickets', [TicketController::class, 'adminIndex']);
        Route::put('tickets/{ticket}', [TicketController::class, 'update']);
        Route::delete('tickets/{ticket}', [TicketController::class, 'destroy']);
    });

    // Rotte per prenotazioni spettacoli
    Route::prefix('bookings')->group(function () {
        Route::post('shows', [App\Http\Controllers\Api\ShowBookingController::class, 'store']);
        Route::get('shows', [App\Http\Controllers\Api\ShowBookingController::class, 'index']);
    });
});

// Rotte pubbliche (senza autenticazione)
Route::get('/attractions', [AttractionController::class, 'index']);
Route::get('/attractions/{id}', [AttractionController::class, 'show']);

// Aggiungi queste route mancanti
Route::get('/restaurants', [RestaurantController::class, 'index']);
Route::get('/restaurants/{id}', [RestaurantController::class, 'show']);

Route::get('/shops', [ShopController::class, 'index']);
Route::get('/shops/{id}', [ShopController::class, 'show']);

Route::get('/services', [ServiceController::class, 'index']);
Route::get('/services/{id}', [ServiceController::class, 'show']);


// Eventuali endpoint pubblici separati, se servono
Route::get('/attractions/public', [AttractionController::class, 'public']);


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

// Rotte per utenti autenticati
// Aggiungi questa rotta nella sezione delle rotte autenticate
Route::middleware('auth:sanctum')->group(function () {
    // Ordini accessibili a tutti gli utenti autenticati
    Route::get('orders', [OrderController::class, 'index']);
    Route::post('orders', [OrderController::class, 'store']);
    Route::get('orders/{id}', [OrderController::class, 'show']);
    Route::get('tickets', [TicketController::class, 'index']);

    // Nuove routes per validazione QR
    Route::post('tickets/validate', [TicketController::class, 'validateQR']);
    Route::put('tickets/update-status', [TicketController::class, 'updateStatus']);

    // Solo admin per gestione avanzata
    // Assicurati che le route admin abbiano il middleware auth:sanctum
    Route::middleware(['auth:sanctum'])->prefix('admin')->group(function () {
        Route::get('stats', [DashboardController::class, 'getStats']);
        Route::get('orders', [OrderController::class, 'adminIndex']);
        // ... altre route admin
    });

    // Rotte per il planner
    Route::get('planner/items', [PlannerController::class, 'index']);
    Route::post('planner/items', [PlannerController::class, 'store']);
    Route::put('planner/items/{id}', [PlannerController::class, 'update']);
    Route::delete('planner/items/{id}', [PlannerController::class, 'destroy']);

    // Aggiungi questa nuova rotta
    Route::get('user/tickets', [TicketController::class, 'getUserTickets']);
    Route::post('/tickets/validate-promo', [PromoCodeController::class, 'validatePromo']);
});
