<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Medine\Apps\ERP\Backend\Controller\Auth\PasswordRequestController;
use Medine\Apps\ERP\Backend\Controller\Auth\ResetPasswordController;
use Medine\Apps\ERP\Backend\Controller\Users\RenameUserController;
use Medine\Apps\ERP\Backend\Controller\Users\UserPostController;

Route::middleware('auth:api')->group(function () {
    Route::post('/users', UserPostController::class);
});

Route::post('/auth/password_request', PasswordRequestController::class);
Route::put('/auth/reset_password', ResetPasswordController::class);
Route::put('/usersRename/{email}', RenameUserController::class);
