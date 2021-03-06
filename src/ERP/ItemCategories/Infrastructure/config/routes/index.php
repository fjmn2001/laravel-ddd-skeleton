<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Medine\ERP\ItemCategories\Infrastructure\Controller\ItemCategoriesGetController;
use Medine\ERP\ItemCategories\Infrastructure\Controller\ItemCategoryGetController;
use Medine\ERP\ItemCategories\Infrastructure\Controller\ItemCategoryOptionsGetController;
use Medine\ERP\ItemCategories\Infrastructure\Controller\ItemCategoryPostController;
use Medine\ERP\ItemCategories\Infrastructure\Controller\ItemCategoryPutController;
use Medine\ERP\ItemCategories\Infrastructure\Controller\ItemCategoryStatePutController;
use Medine\ERP\ItemCategories\Infrastructure\Controller\ItemCategoryStatesGetController;

Route::middleware('auth:api')->group(function () {
    Route::post('/item_categories', ItemCategoryPostController::class);
    Route::put('/item_categories/{id}', ItemCategoryPutController::class);
    Route::get('/item_categories/{id}', ItemCategoryGetController::class);
    Route::get('/item_categories', ItemCategoriesGetController::class);
    Route::get('/item_categories/options/{id}', ItemCategoryOptionsGetController::class);
    Route::get('/item_categories/states/{id}', ItemCategoryStatesGetController::class);
    Route::put('/item_categories/state/{id}', ItemCategoryStatePutController::class);
});
