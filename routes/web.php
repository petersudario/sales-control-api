<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VendasController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MapController;




Route::middleware('auth')->group(function () {
    Route::get('/profile', [MapController::class, 'index'])->name('profile.edit');
    Route::get('/', [MapController::class, 'index'])->name('home');

    Route::get('/unidades/total-sales', [MapController::class, 'getTotalSales']);

    Route::get('/vendas', [VendasController::class, 'index'])->name('vendas.index');


    Route::get('/unidades/{currentUnidadeId}/nearby', [VendasController::class, 'searchNearbyUnidades']);
    
});




require __DIR__ . '/auth.php';
