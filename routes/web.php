<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\InvoiceController;

use Illuminate\Support\Facades\Auth;


Auth::routes();

// Ruta para redirigir a la vista de login
Route::get('/', [HomeController::class, 'index'])->name('home');

// Rutas para pago de facturas
Route::get('/pay/mercadopago/{invoice}', [PaymentController::class, 'payWithMercadoPago'])->name('pay.mercadopago');
Route::get('/payment/success/{invoice}', [PaymentController::class, 'paymentSuccess'])->name('payment.success');
Route::get('/payment/failed/{invoice}', [PaymentController::class, 'paymentFailed'])->name('payment.failed');
Route::post('/pay/manual/{invoice}', [PaymentController::class, 'manualPayment'])->name('pay.manual');

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

    // Rutas para gestion de facturas
    Route::resource('invoices', InvoiceController::class);
    Route::post('/invoice/{invoice}/confirm', [PaymentController::class, 'manualPaymentConfirm'])->middleware('auth')->name('pay.confirm');
});
