<?php

use Illuminate\Support\Facades\Route;
use Medine\Apps\ERP\Backend\Controller\Provider\ProviderGetController;
use Medine\Apps\ERP\Backend\Controller\Provider\ProviderPostController;
use Medine\Apps\ERP\Backend\Controller\Provider\ProviderPutController;

Route::middleware('auth:api')->group(function (){
    Route::post('/provider', ProviderPostController::class);
    Route::put('/provider/{id}', ProviderPutController::class);
    Route::get('/provider/{id}', ProviderGetController::class);
});
