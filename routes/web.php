<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\PaymentController;

use Illuminate\Support\Facades\Auth;


Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::post('/pending-payments', [HomeController::class, 'getPendingPayments'])->name('pending.payments');

// Grupo de rutas protegidas con autenticación (si se usa auth)
Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Rutas para gestión de clientes
    Route::resource('clients', ClientController::class);

    // Rutas para gestión de servicios
    Route::resource('services', ServiceController::class);

    // Rutas para gestión de suscripciones
    Route::resource('subscriptions', SubscriptionController::class);

    // Rutas para gestión de pagos
    Route::resource('payments', PaymentController::class);
});