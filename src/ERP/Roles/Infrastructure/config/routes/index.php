<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Medine\Apps\ERP\Backend\Controller\Roles\RolesGetController;
use Medine\Apps\ERP\Backend\Controller\Roles\RolGetController;
use Medine\Apps\ERP\Backend\Controller\Roles\RolPostController;
use Medine\Apps\ERP\Backend\Controller\Roles\RolPutController;

Route::middleware('auth:api')->group(function () {
    Route::post('/roles', RolPostController::class);
    Route::put('/roles/{id}', RolPutController::class);
    Route::get('/roles/{id}', RolGetController::class);
    Route::get('/roles', RolesGetController::class);
});
