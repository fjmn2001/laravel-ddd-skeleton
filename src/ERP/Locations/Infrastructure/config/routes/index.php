<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Medine\ERP\Locations\Infrastructure\Controller\LocationGetController;
use Medine\ERP\Locations\Infrastructure\Controller\LocationOptionsGetController;
use Medine\ERP\Locations\Infrastructure\Controller\LocationPostController;
use Medine\ERP\Locations\Infrastructure\Controller\LocationsBreadcrumbsGetController;
use Medine\ERP\Locations\Infrastructure\Controller\LocationsCatalogsGetController;
use Medine\ERP\Locations\Infrastructure\Controller\LocationsGetController;

Route::middleware('auth:api')->group(function () {
    //get
    Route::get('/locations/catalogs/{companyId}', LocationsCatalogsGetController::class);
    Route::get('/locations/options/{id}', LocationOptionsGetController::class);
    Route::get('/locations/{id}', LocationGetController::class);
    Route::get('/locations', LocationsGetController::class);

    //post
    Route::post('/locations', LocationPostController::class);
    Route::post('/locations/breadcrumbs', LocationsBreadcrumbsGetController::class);
});
