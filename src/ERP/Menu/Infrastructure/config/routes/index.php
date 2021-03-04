<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Medine\ERP\Menu\Infrastructure\Controller\TopMenuGetController;

Route::middleware('auth:api')->group(function () {
    Route::get('/menu/top_menu', TopMenuGetController::class);
});
