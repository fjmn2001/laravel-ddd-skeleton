<?php

use Illuminate\Support\Facades\Route;
use Medine\ERP\Product\Infrastructure\Controller\Product\ProductPostController;
use Medine\ERP\Product\Infrastructure\Controller\Product\ProductPutController;
use Medine\ERP\Product\Infrastructure\Controller\ProductsCountGetController;
use Medine\ERP\Product\Infrastructure\Controller\ProductsGetController;

Route::middleware('auth:api')->group(function () {
    //get
    Route::get('/products/count', ProductsCountGetController::class);
    Route::get('/products', ProductsGetController::class);

    //post
    Route::post('/product', ProductPostController::class);

    //put
    Route::put('/product/{id}', ProductPutController::class);

});
