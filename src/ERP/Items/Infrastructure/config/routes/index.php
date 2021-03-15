<?php

use Illuminate\Support\Facades\Route;
use Medine\ERP\Items\Infrastructure\Controller\Item\ItemPostController;
use Medine\ERP\Items\Infrastructure\Controller\Item\ItemPutController;
use Medine\ERP\Items\Infrastructure\Controller\ItemsCountGetController;
use Medine\ERP\Items\Infrastructure\Controller\ItemsGetController;


Route::middleware('auth:api')->group(function () {
    //get
    Route::get('/items/count', ItemsCountGetController::class);
    Route::get('/items', ItemsGetController::class);

    //post
    Route::post('/items', ItemPostController::class);

    //put
    Route::put('/items/{id}', ItemPutController::class);

});
