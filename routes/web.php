<?php

use App\Http\Controllers\Products\ProductGetController;
use App\Http\Controllers\Products\ProductPutController;
use App\Http\Controllers\Products\ProductsGetController;
use App\Http\Controllers\ProductStockMovements\ProductStockMovementPutController;
use App\Http\Controllers\ProductStockMovements\ProductStockMovementsGetController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function(){
    return View::make('home');
});


Route::name('view-movements')->prefix('view-movements')->group(function () {
    Route::get('{productId}', function () {
        return View::make('movements');
    });
});

Route::name('products')->prefix('products')->group(function () {
    Route::get('/', ProductsGetController::class);

    Route::name('.product')->prefix('{productId}')->group(function () {
        Route::get('/', ProductGetController::class);

        Route::put('/', ProductPutController::class);
    });
});

Route::name('.movements')->prefix('movements')->group(function () {
    Route::get('/', ProductStockMovementsGetController::class);

    Route::name('.movement')->prefix('{productStockMovementId}')->group(function () {
        Route::put('/', ProductStockMovementPutController::class);
    });
});
