<?php

use Illuminate\Support\Facades\Route;
//use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Api\PromoCodeController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\TicketController;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\AttractionController;
use App\Http\Controllers\ShowController;
use App\Http\Controllers\VisitHistoryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MockCreditCardController;

// Dashboard principale
/* Route::get('/', [DashboardController::class, 'index'])->name('dashboard'); */

// Route principale che mostra solo lo stato del server
Route::get('/', function () {
    return view('server-status');
});

Route::fallback(function () {
    return response()->json(['message' => 'Not Found'], 404);
});

// Rotte CRUD per Users
Route::post('/users', [UserController::class, 'store'])->name('users.store');
Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.delete');

// Rotte CRUD per Orders
Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
Route::put('/orders/{id}', [OrderController::class, 'update'])->name('orders.update');
Route::delete('/orders/{id}', [OrderController::class, 'destroy'])->name('orders.delete');

// Rotte CRUD per Tickets
Route::post('/tickets', [TicketController::class, 'store'])->name('tickets.store');
Route::put('/tickets/{id}', [TicketController::class, 'update'])->name('tickets.update');
Route::delete('/tickets/{id}', [TicketController::class, 'destroy'])->name('tickets.delete');

// Rotte CRUD per Attractions
Route::post('/attractions', [AttractionController::class, 'store'])->name('attractions.store');
Route::put('/attractions/{id}', [AttractionController::class, 'update'])->name('attractions.update');
Route::delete('/attractions/{id}', [AttractionController::class, 'destroy'])->name('attractions.delete');

// Rotte CRUD per Shows
Route::get('/shows/{id}', [ShowController::class, 'show'])->name('shows.show');
Route::post('/shows', [ShowController::class, 'store'])->name('shows.store');
Route::put('/shows/{id}', [ShowController::class, 'update'])->name('shows.update');
Route::delete('/shows/{id}', [ShowController::class, 'destroy'])->name('shows.delete');

// Rotte CRUD per Restaurants
Route::get('/restaurants/{id}', [RestaurantController::class, 'show'])->name('restaurants.show');
Route::post('/restaurants', [RestaurantController::class, 'store'])->name('restaurants.store');
Route::put('/restaurants/{id}', [RestaurantController::class, 'update'])->name('restaurants.update');
Route::delete('/restaurants/{id}', [RestaurantController::class, 'destroy'])->name('restaurants.delete');

// Rotte CRUD per Shops
Route::get('/shops/{id}', [ShopController::class, 'show'])->name('shops.show');
Route::post('/shops', [ShopController::class, 'store'])->name('shops.store');
Route::put('/shops/{id}', [ShopController::class, 'update'])->name('shops.update');
Route::delete('/shops/{id}', [ShopController::class, 'destroy'])->name('shops.delete');

// Rotte CRUD per Services
Route::get('/services/{id}', [ServiceController::class, 'show'])->name('services.show');
Route::post('/services', [ServiceController::class, 'store'])->name('services.store');
Route::put('/services/{id}', [ServiceController::class, 'update'])->name('services.update');
Route::delete('/services/{id}', [ServiceController::class, 'destroy'])->name('services.delete');

// Rotte CRUD per PromoCode
Route::post('/promo-codes', [PromoCodeController::class, 'store'])->name('promo-codes.store');
Route::put('/promo-codes/{id}', [PromoCodeController::class, 'update'])->name('promo-codes.update');
Route::delete('/promo-codes/{id}', [PromoCodeController::class, 'destroy'])->name('promo-codes.delete');

// Rotte CRUD per VisitHistory
Route::post('/visit-histories', [VisitHistoryController::class, 'store'])->name('visit-histories.store');
Route::put('/visit-histories/{id}', [VisitHistoryController::class, 'update'])->name('visit-histories.update');
Route::delete('/visit-histories/{id}', [VisitHistoryController::class, 'destroy'])->name('visit-histories.delete');

// Rotte CRUD per MockCreditCard
Route::post('/mock-credit-cards', [MockCreditCardController::class, 'store'])->name('mock-credit-cards.store');
Route::put('/mock-credit-cards/{id}', [MockCreditCardController::class, 'update'])->name('mock-credit-cards.update');
Route::delete('/mock-credit-cards/{id}', [MockCreditCardController::class, 'destroy'])->name('mock-credit-cards.delete');

// Aggiungere rotte simili per gli altri modelli
// ...