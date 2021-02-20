<?php

use Illuminate\Support\Facades\Route;
use Medine\Apps\ERP\Backend\Controller\Clients\ClientGetController;
use Medine\Apps\ERP\Backend\Controller\Clients\ClientPostController;


Route::middleware('auth:api')->group(function () {
    Route::post('/client', ClientPostController::class);
    Route::get('/client/{id}', ClientGetController::class);
});
