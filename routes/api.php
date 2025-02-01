<?php

use App\Http\Controllers\productController;
use App\Http\Controllers\StockMovementController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::prefix('products')->group(function () {
    Route::get('/', [productController::class, 'getAllProducts']);
    Route::get('/{id}', [ProductController::class, 'getProductById']);
    Route::post('/', [ProductController::class, 'createProduct']);
    Route::put('/{id}', [ProductController::class, 'updateProduct']);
    Route::delete('/{id}', [ProductController::class, 'deleteProduct']);
});

Route::prefix('stock-movements')->group(function () {
    Route::get('/', [StockMovementController::class, 'getAllStockMovements']);
    Route::get('/{id}', [StockMovementController::class, 'getStockMovementById']);
    Route::post('/', [StockMovementController::class, 'createStockMovement']);
});