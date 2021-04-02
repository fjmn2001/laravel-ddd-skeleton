<?php

use Illuminate\Support\Facades\Route;
use Medine\ERP\ClientTypes\Infrastructure\Controllers\ClientTypeGetController;
use Medine\ERP\ClientTypes\Infrastructure\Controllers\ClientTypeOptionsGetController;
use Medine\ERP\ClientTypes\Infrastructure\Controllers\ClientTypePostController;
use Medine\ERP\ClientTypes\Infrastructure\Controllers\ClientTypePutController;
use Medine\ERP\ClientTypes\Infrastructure\Controllers\ClientTypesGetController;
use Medine\ERP\ClientTypes\Infrastructure\Controllers\ClientTypeStatePutController;
use Medine\ERP\ClientTypes\Infrastructure\Controllers\ClientTypeStatesGetController;


Route::middleware('auth:api')->group(function () {
    Route::post('/client_type', ClientTypePostController::class);

    Route::get('/client_type/{id}', ClientTypeGetController::class);
    Route::get('/client_type/states/{id}', ClientTypeStatesGetController::class);
    Route::get('/client_type/options/{id}', ClientTypeOptionsGetController::class);
    Route::get('/client_types', ClientTypesGetController::class);

    Route::put('/client_type/{id}', ClientTypePutController::class);
    Route::put('/client_type/state/{id}', ClientTypeStatePutController::class);

});
