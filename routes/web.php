<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;

// Dashboard principale
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

// Rotte CRUD per Users
Route::post('/users', [DashboardController::class, 'storeUser'])->name('users.store');
Route::put('/users/{id}', [DashboardController::class, 'updateUser'])->name('users.update');
Route::delete('/users/{id}', [DashboardController::class, 'deleteUser'])->name('users.delete');

// Rotte CRUD per Orders
Route::post('/orders', [DashboardController::class, 'storeOrder'])->name('orders.store');
Route::put('/orders/{id}', [DashboardController::class, 'updateOrder'])->name('orders.update');
Route::delete('/orders/{id}', [DashboardController::class, 'deleteOrder'])->name('orders.delete');

// Rotte CRUD per Tickets
Route::post('/tickets', [DashboardController::class, 'storeTicket'])->name('tickets.store');
Route::put('/tickets/{id}', [DashboardController::class, 'updateTicket'])->name('tickets.update');
Route::delete('/tickets/{id}', [DashboardController::class, 'deleteTicket'])->name('tickets.delete');

// Rotte CRUD per Attractions
Route::post('/attractions', [DashboardController::class, 'storeAttraction'])->name('attractions.store');
Route::put('/attractions/{id}', [DashboardController::class, 'updateAttraction'])->name('attractions.update');
Route::delete('/attractions/{id}', [DashboardController::class, 'deleteAttraction'])->name('attractions.delete');

// Rotte CRUD per Shows
Route::post('/shows', [DashboardController::class, 'storeShow'])->name('shows.store');
Route::put('/shows/{id}', [DashboardController::class, 'updateShow'])->name('shows.update');
Route::delete('/shows/{id}', [DashboardController::class, 'deleteShow'])->name('shows.delete');

// Rotte CRUD per Restaurants
Route::post('/restaurants', [DashboardController::class, 'storeRestaurant'])->name('restaurants.store');
Route::put('/restaurants/{id}', [DashboardController::class, 'updateRestaurant'])->name('restaurants.update');
Route::delete('/restaurants/{id}', [DashboardController::class, 'deleteRestaurant'])->name('restaurants.delete');

// Rotte CRUD per Shops
Route::post('/shops', [DashboardController::class, 'storeShop'])->name('shops.store');
Route::put('/shops/{id}', [DashboardController::class, 'updateShop'])->name('shops.update');
Route::delete('/shops/{id}', [DashboardController::class, 'deleteShop'])->name('shops.delete');

// Rotte CRUD per Services
Route::post('/services', [DashboardController::class, 'storeService'])->name('services.store');
Route::put('/services/{id}', [DashboardController::class, 'updateService'])->name('services.update');
Route::delete('/services/{id}', [DashboardController::class, 'deleteService'])->name('services.delete');

// Rotte CRUD per Locations
Route::post('/locations', [DashboardController::class, 'storeLocation'])->name('locations.store');
Route::put('/locations/{id}', [DashboardController::class, 'updateLocation'])->name('locations.update');
Route::delete('/locations/{id}', [DashboardController::class, 'deleteLocation'])->name('locations.delete');

// Rotte CRUD per PromoCode
Route::post('/promo-codes', [DashboardController::class, 'storePromoCode'])->name('promo-codes.store');
Route::put('/promo-codes/{id}', [DashboardController::class, 'updatePromoCode'])->name('promo-codes.update');
Route::delete('/promo-codes/{id}', [DashboardController::class, 'deletePromoCode'])->name('promo-codes.delete');

// Rotte CRUD per VisitHistory
Route::post('/visit-histories', [DashboardController::class, 'storeVisitHistory'])->name('visit-histories.store');
Route::put('/visit-histories/{id}', [DashboardController::class, 'updateVisitHistory'])->name('visit-histories.update');
Route::delete('/visit-histories/{id}', [DashboardController::class, 'deleteVisitHistory'])->name('visit-histories.delete');

// Rotte CRUD per MockCreditCard
Route::post('/mock-credit-cards', [DashboardController::class, 'storeMockCreditCard'])->name('mock-credit-cards.store');
Route::put('/mock-credit-cards/{id}', [DashboardController::class, 'updateMockCreditCard'])->name('mock-credit-cards.update');
Route::delete('/mock-credit-cards/{id}', [DashboardController::class, 'deleteMockCreditCard'])->name('mock-credit-cards.delete');

// Aggiungere rotte simili per gli altri modelli
// ...
