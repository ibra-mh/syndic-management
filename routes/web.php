<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TrancheController;
use App\Http\Controllers\ImmeubleController;
use App\Http\Controllers\AppartementController;
use App\Http\Controllers\CotisationController;
use App\Http\Controllers\DepenseController;
use App\Http\Controllers\ExpenseTypeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('dashboard');
    }
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Admin routes
    Route::middleware('admin')->group(function () {
        // Tranches
        Route::resource('tranches', TrancheController::class);
        
        // Immeubles  
        Route::resource('immeubles', ImmeubleController::class);
        
        // Appartements
        Route::resource('appartements', AppartementController::class);
        
        // Cotisations
        Route::resource('cotisations', CotisationController::class);
        
        // Dépenses
        Route::resource('depenses', DepenseController::class);
        
        // Types de dépenses
        Route::resource('expense-types', ExpenseTypeController::class);
    });
});

require __DIR__.'/auth.php';
