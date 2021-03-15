<?php

use Illuminate\Support\Facades\Route;
use Medine\ERP\Item\Infrastructure\Controller\Item\ItemPostController;
use Medine\ERP\Item\Infrastructure\Controller\Item\ItemPutController;
use Medine\ERP\Item\Infrastructure\Controller\ItemsCountGetController;


Route::middleware('auth:api')->group(function () {
    //get
    Route::get('/item/count', ItemsCountGetController::class);

    //post
    Route::post('/item', ItemPostController::class);

    //put
    Route::put('/item/{id}', ItemPutController::class);

});
