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
    Route::post('/_client_type', ClientTypePostController::class);

    Route::get('/_client_type/{id}', ClientTypeGetController::class);
    Route::get('/_client_type/states/{id}', ClientTypeStatesGetController::class);
    Route::get('/_client_type/options/{id}', ClientTypeOptionsGetController::class);
    Route::get('/_client_type', ClientTypesGetController::class);

    Route::put('/_client_type/{id}', ClientTypePutController::class);
    Route::put('/_client_type/state/{id}', ClientTypeStatePutController::class);

});
