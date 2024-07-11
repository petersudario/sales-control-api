<?php

use App\Http\Controllers\VendasController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/diretorias', [VendasController::class, 'getAllDiretorias']);
Route::get('/unidades/{diretoria_id}/filter', [VendasController::class, 'filterUnidades']);
Route::get('/vendedores/{unidade_id}/filter', [VendasController::class, 'filterVendedores']);