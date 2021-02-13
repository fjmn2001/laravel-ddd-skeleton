<?php

use Illuminate\Support\Facades\Route;
use Medine\Apps\ERP\Backend\Controller\Product\ProductPostController;

Route::middleware('auth:api')->group(function () {
    Route::post('/product', ProductPostController::class);
});
