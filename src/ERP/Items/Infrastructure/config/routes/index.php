<?php

use Illuminate\Support\Facades\Route;
use Medine\ERP\Items\Infrastructure\Controller\Item\ItemPostController;
use Medine\ERP\Items\Infrastructure\Controller\Item\ItemPutController;
use Medine\ERP\Items\Infrastructure\Controller\ItemsCountGetController;


Route::middleware('auth:api')->group(function () {
    //get
    Route::get('/items/count', ItemsCountGetController::class);

    //post
    Route::post('/items', ItemPostController::class);

    //put
    Route::put('/items/{id}', ItemPutController::class);

});
