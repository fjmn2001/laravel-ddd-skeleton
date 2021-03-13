<?php

use Illuminate\Support\Facades\Route;
use Medine\ERP\Product\Infrastructure\Controller\Product\ProductPostController;
use Medine\ERP\Product\Infrastructure\Controller\Product\ProductPutController;
use Medine\ERP\Product\Infrastructure\Controller\ProductsCountGetController;

Route::middleware('auth:api')->group(function () {
    //get
    Route::get('/products/count', ProductsCountGetController::class);

    //post
    Route::post('/product', ProductPostController::class);

    //put
    Route::put('/product/{id}', ProductPutController::class);

});
