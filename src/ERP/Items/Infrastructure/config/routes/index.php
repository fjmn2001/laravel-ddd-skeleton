<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Medine\ERP\Items\Infrastructure\Controller\ItemsCountGetController;
use Medine\ERP\Items\Infrastructure\Controller\ItemsGetController;
use Medine\ERP\Items\Infrastructure\Controller\ItemGetController;
use Medine\ERP\Items\Infrastructure\Controller\ItemOptionsGetController;
use Medine\ERP\Items\Infrastructure\Controller\ItemPostController;
use Medine\ERP\Items\Infrastructure\Controller\ItemPutController;
use Medine\ERP\Items\Infrastructure\Controller\ItemStatePutController;
use Medine\ERP\Items\Infrastructure\Controller\ItemStatesGetController;

Route::middleware('auth:api')->group(function () {
    //get
    Route::get('/items', ItemsGetController::class);
    Route::get('/items/count', ItemsCountGetController::class);
    Route::get('/items/{id}', ItemGetController::class);
    Route::get('/items/options/{id}', ItemOptionsGetController::class);
    Route::get('/items/states/{id}', ItemStatesGetController::class);

    //post
    Route::post('/items', ItemPostController::class);

    //put
    Route::put('/items/{id}', ItemPutController::class);
    Route::put('/items/state/{id}', ItemStatePutController::class);
});
