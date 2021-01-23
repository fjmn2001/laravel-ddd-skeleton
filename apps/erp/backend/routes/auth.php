<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Medine\Apps\ERP\Backend\Controller\Auth\AuthController;

Route::post('/auth/login', [AuthController::class, 'login']);
Route::middleware('auth:api')->post('/auth/logout', [AuthController::class, 'logout']);
