<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CotizacionController;
use App\Http\Controllers\PageController;

// Endpoint para el conversor de dólares
Route::get('/convertir', [CotizacionController::class, 'convertir']);

// Endpoint para el ejemplo de Guzzle (JSONPlaceholder)
Route::get('/get-todo', [PageController::class, 'getTodoExample']);