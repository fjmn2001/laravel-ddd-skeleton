<?php

use Illuminate\Support\Facades\Route;
use Medine\ERP\Provider\Infrastructure\Controllers\ProviderGetController;
use Medine\ERP\Provider\Infrastructure\Controllers\ProviderPostController;
use Medine\ERP\Provider\Infrastructure\Controllers\ProviderPutController;

Route::middleware('auth:api')->group(function (){
    Route::post('/provider', ProviderPostController::class);
    Route::put('/provider/{id}', ProviderPutController::class);
    Route::get('/provider/{id}', ProviderGetController::class);
});
