<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\ImmeubleController;
use App\Http\Controllers\TrancheController;
use App\Http\Controllers\AppartementController;
use App\Http\Controllers\CotisationController;
use App\Http\Controllers\DepenseController;
use App\Http\Controllers\ExpenseTypeController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('admin.dashboard');
});

// Authentication Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
    // Client Dashboard Route
    Route::get('/dashboard', [DashboardController::class, 'admin'])->name('dashboard');
    
    // Admin Routes
    Route::middleware('admin')->prefix('admin')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'admin'])->name('admin.dashboard');
        
        // Resources Management
        Route::resource('tranches', TrancheController::class);
        Route::resource('immeubles', ImmeubleController::class);
        Route::resource('appartements', AppartementController::class);
        Route::resource('cotisations', CotisationController::class);
        Route::resource('depenses', DepenseController::class);
        Route::resource('expense-types', ExpenseTypeController::class);
        
        // AJAX Routes for dynamic dropdowns
        Route::get('/ajax/immeubles-by-tranche', [CotisationController::class, 'getImmeublesbyTranche'])
            ->name('ajax.immeubles-by-tranche');
        Route::get('/ajax/appartements-by-immeuble', [CotisationController::class, 'getAppartementsByImmeuble'])
            ->name('ajax.appartements-by-immeuble');
    });
});
