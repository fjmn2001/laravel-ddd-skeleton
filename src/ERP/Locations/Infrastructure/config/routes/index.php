<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Medine\ERP\Locations\Infrastructure\Controller\LocationGetController;
use Medine\ERP\Locations\Infrastructure\Controller\LocationPostController;

Route::middleware('auth:api')->group(function () {
    //get
    Route::get('/locations/{id}', LocationGetController::class);

    //post
    Route::post('/locations', LocationPostController::class);
});
