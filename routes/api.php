<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductController;

// Standard-REST-Routen für Produkte
Route::apiResource('products', ProductController::class);

// Spezielle Route für das Hinzufügen mehrerer Produkte
Route::post('products/jsonList', [ProductController::class, 'storeJsonList']);

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
