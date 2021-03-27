<?php

use Illuminate\Support\Facades\Route;
use Medine\Apps\ERP\Backend\Controller\Clients\ClientBreadcrumbsPostController;
use Medine\Apps\ERP\Backend\Controller\Clients\ClientesGetController;
use Medine\Apps\ERP\Backend\Controller\Clients\ClientGetController;
use Medine\Apps\ERP\Backend\Controller\Clients\ClientOptionsGetController;
use Medine\Apps\ERP\Backend\Controller\Clients\ClientPostController;
use Medine\Apps\ERP\Backend\Controller\Clients\ClientPutController;
use Medine\Apps\ERP\Backend\Controller\Clients\ClientStatePutController;
use Medine\Apps\ERP\Backend\Controller\Clients\ClientStatesGetController;


Route::middleware('auth:api')->group(function () {
    Route::post('/client/breadcrumbs', ClientBreadcrumbsPostController::class);
    Route::post('/client', ClientPostController::class);

    Route::get('/client/{id}', ClientGetController::class);
    Route::get('/client/states/{id}', ClientStatesGetController::class);
    Route::get('/client/options/{id}', ClientOptionsGetController::class);
    Route::get('/client', ClientesGetController::class);

    Route::put('/client/{id}', ClientPutController::class);
    Route::put('/client/state/{id}', ClientStatePutController::class);

});
