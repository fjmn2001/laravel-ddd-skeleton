<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Medine\Apps\ERP\Backend\Controller\Roles\RolPostController;

Route::middleware('auth:api')->group(function () {
    Route::post('/roles', RolPostController::class);
});
