<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Medine\Apps\ERP\Backend\Controller\Locations\LocationsPostController;

Route::middleware('auth:api')->group(function () {
    Route::post('/location', LocationsPostController::class);
});
