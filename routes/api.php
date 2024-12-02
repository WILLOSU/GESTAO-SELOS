<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    UsuarioController,
    VendedorController,
    SeloController
};

// Rotas de Usuários
Route::apiResource('usuarios', UsuarioController::class);

// Rotas de Vendedores
Route::apiResource('vendedores', VendedorController::class);

// Rotas de Selos
Route::prefix('selos')->group(function () {
    Route::get('disponiveis', [SeloController::class, 'disponiveis']);
    Route::post('{selo}/vender', [SeloController::class, 'vender']);
});
Route::apiResource('selos', SeloController::class);
