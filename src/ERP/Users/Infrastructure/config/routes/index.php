<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Medine\Apps\ERP\Backend\Controller\Users\UserPostController;

Route::middleware('auth:api')->group(function () {
    Route::post('/users', UserPostController::class);
});
