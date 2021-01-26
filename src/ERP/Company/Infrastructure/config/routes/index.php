<?php

use Illuminate\Support\Facades\Route;
use Medine\Apps\ERP\Backend\Controller\Company\CompanyPostController;

Route::middleware('auth:api')->group(function () {
    Route::post('/company', CompanyPostController::class);
});
