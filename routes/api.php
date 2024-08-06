<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EstrategiaWMS;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// region Estrategia
Route::post('/estrategiaWMS', EstrategiaWMS\StoreController::class)->name('estrategia.store');
Route::get('/estrategiaWMS/{cdEstrategia}/{dsHora}/{dsMinuto}/prioridade',EstrategiaWMS\PrioridadeController::class)->name('estrategia.prioridade');
// endregion
