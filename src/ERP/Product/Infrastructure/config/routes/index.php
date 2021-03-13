<?php

use Illuminate\Support\Facades\Route;
use Medine\ERP\Product\Infrastructure\Controller\Product\ProductPostController;
use Medine\ERP\Product\Infrastructure\Controller\Product\ProductPutController;

Route::middleware('auth:api')->group(function () {
    Route::post('/product', ProductPostController::class);
    Route::put('/product/{id}', ProductPutController::class);
});
