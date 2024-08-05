<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EstrategiaWMS;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// region Estrategia
Route::post('/estrategiaWMS', [EstrategiaWMS\StoreController::class, 'store'])->name('estrategia.store');
// endregion
