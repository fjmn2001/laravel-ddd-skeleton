<?php

use Illuminate\Support\Facades\Route;
use Medine\ERP\ClientCategories\Infrastructure\Controllers\ClientCategoriesGetController;
use Medine\ERP\ClientCategories\Infrastructure\Controllers\ClientCategoryGetController;
use Medine\ERP\ClientCategories\Infrastructure\Controllers\ClientCategoryOptionsGetController;
use Medine\ERP\ClientCategories\Infrastructure\Controllers\ClientCategoryPostController;
use Medine\ERP\ClientCategories\Infrastructure\Controllers\ClientCategoryPutController;
use Medine\ERP\ClientCategories\Infrastructure\Controllers\ClientCategoryStatePutController;
use Medine\ERP\ClientCategories\Infrastructure\Controllers\ClientCategoryStatesGetController;


Route::middleware('auth:api')->group(function () {
    Route::post('/client_category', ClientCategoryPostController::class);

    Route::get('/client_category/{id}', ClientCategoryGetController::class);
    Route::get('/client_category/states/{id}', ClientCategoryStatesGetController::class);
    Route::get('/client_category/options/{id}', ClientCategoryOptionsGetController::class);
    Route::get('/client_category', ClientCategoriesGetController::class);

    Route::put('/client_category/{id}', ClientCategoryPutController::class);
    Route::put('/client_category/state/{id}', ClientCategoryStatePutController::class);

});
