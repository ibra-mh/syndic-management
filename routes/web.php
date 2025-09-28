
<?php

// Language routes
use App\Http\Controllers\LanguageController;
Route::get('/language/{locale}', [LanguageController::class, 'change'])->name('language.change');

// Buildings routes
use App\Http\Controllers\BuildingController;
Route::get('/buildings', [BuildingController::class, 'index'])->name('buildings.index');
Route::get('/buildings/create', [BuildingController::class, 'create'])->name('buildings.create');
Route::post('/buildings', [BuildingController::class, 'store'])->name('buildings.store');
Route::get('/buildings/{building}/edit', [BuildingController::class, 'edit'])->name('buildings.edit');
Route::put('/buildings/{building}', [BuildingController::class, 'update'])->name('buildings.update');
Route::delete('/buildings/{building}', [BuildingController::class, 'destroy'])->name('buildings.destroy');

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TrancheController;
// use App\Http\Controllers\ImmeubleController;
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

// Public create routes (no auth required for testing)
// Route::get('/immeubles/create', [ImmeubleController::class, 'create'])->name('immeubles.create');
Route::get('/tranches/create', [TrancheController::class, 'create'])->name('tranches.create');
Route::get('/appartements/create', [AppartementController::class, 'create'])->name('appartements.create');
Route::get('/cotisations/create', [CotisationController::class, 'create'])->name('cotisations.create');
Route::get('/depenses/create', [DepenseController::class, 'create'])->name('depenses.create');
Route::get('/expense-types/create', [ExpenseTypeController::class, 'create'])->name('expense-types.create');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Shared routes for both admin and clients (read-only for clients)
    Route::get('/tranches', [TrancheController::class, 'index'])->name('tranches.index');
    Route::get('/tranches/{tranche}', [TrancheController::class, 'show'])->name('tranches.show');
    
    // Route::get('/immeubles', [ImmeubleController::class, 'index'])->name('immeubles.index');
    // Route::get('/immeubles/{immeuble}', [ImmeubleController::class, 'show'])->name('immeubles.show');
    
    Route::get('/appartements', [AppartementController::class, 'index'])->name('appartements.index');
    Route::get('/appartements/{appartement}', [AppartementController::class, 'show'])->name('appartements.show');
    
    Route::get('/cotisations', [CotisationController::class, 'index'])->name('cotisations.index');
    Route::get('/cotisations/{cotisation}', [CotisationController::class, 'show'])->name('cotisations.show');
    
    Route::get('/depenses', [DepenseController::class, 'index'])->name('depenses.index');
    Route::get('/depenses/{depense}', [DepenseController::class, 'show'])->name('depenses.show');
    
    Route::get('/expense-types', [ExpenseTypeController::class, 'index'])->name('expense-types.index');
    Route::get('/expense-types/{expense_type}', [ExpenseTypeController::class, 'show'])->name('expense-types.show');
    
    // Admin-only routes (store, edit, update, delete - create routes are now public above)
    Route::middleware('admin')->group(function () {
        // Tranches
        Route::post('/tranches', [TrancheController::class, 'store'])->name('tranches.store');
        Route::get('/tranches/{tranche}/edit', [TrancheController::class, 'edit'])->name('tranches.edit');
        Route::put('/tranches/{tranche}', [TrancheController::class, 'update'])->name('tranches.update');
        Route::delete('/tranches/{tranche}', [TrancheController::class, 'destroy'])->name('tranches.destroy');
        
    // Route::post('/immeubles', [ImmeubleController::class, 'store'])->name('immeubles.store');
    // Route::get('/immeubles/{immeuble}/edit', [ImmeubleController::class, 'edit'])->name('immeubles.edit');
    // Route::put('/immeubles/{immeuble}', [ImmeubleController::class, 'update'])->name('immeubles.update');
    // Route::delete('/immeubles/{immeuble}', [ImmeubleController::class, 'destroy'])->name('immeubles.destroy');
        
        // Appartements
        Route::post('/appartements', [AppartementController::class, 'store'])->name('appartements.store');
        Route::get('/appartements/{appartement}/edit', [AppartementController::class, 'edit'])->name('appartements.edit');
        Route::put('/appartements/{appartement}', [AppartementController::class, 'update'])->name('appartements.update');
        Route::delete('/appartements/{appartement}', [AppartementController::class, 'destroy'])->name('appartements.destroy');
        
        // Cotisations
        Route::post('/cotisations', [CotisationController::class, 'store'])->name('cotisations.store');
        Route::get('/cotisations/{cotisation}/edit', [CotisationController::class, 'edit'])->name('cotisations.edit');
        Route::put('/cotisations/{cotisation}', [CotisationController::class, 'update'])->name('cotisations.update');
        Route::delete('/cotisations/{cotisation}', [CotisationController::class, 'destroy'])->name('cotisations.destroy');
        
        // Dépenses
        Route::post('/depenses', [DepenseController::class, 'store'])->name('depenses.store');
        Route::get('/depenses/{depense}/edit', [DepenseController::class, 'edit'])->name('depenses.edit');
        Route::put('/depenses/{depense}', [DepenseController::class, 'update'])->name('depenses.update');
        Route::delete('/depenses/{depense}', [DepenseController::class, 'destroy'])->name('depenses.destroy');
        
        // Types de dépenses
        Route::post('/expense-types', [ExpenseTypeController::class, 'store'])->name('expense-types.store');
        Route::get('/expense-types/{expense_type}/edit', [ExpenseTypeController::class, 'edit'])->name('expense-types.edit');
        Route::put('/expense-types/{expense_type}', [ExpenseTypeController::class, 'update'])->name('expense-types.update');
        Route::delete('/expense-types/{expense_type}', [ExpenseTypeController::class, 'destroy'])->name('expense-types.destroy');
    });
});

require __DIR__.'/auth.php';
