<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VendasController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MapController;




Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/', [MapController::class, 'index']);

    Route::get('/unidades/total-sales', [MapController::class, 'getTotalSales']);

    Route::get('/vendas', [VendasController::class, 'index'])->name('vendas.index');


    Route::get('/unidades/{currentUnidadeId}/nearby', [VendasController::class, 'searchNearbyUnidades']);
    
});




require __DIR__ . '/auth.php';
