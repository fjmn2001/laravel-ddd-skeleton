<?php

use Illuminate\Support\Facades\Route;
use Medine\Apps\ERP\Backend\Controller\Company\CompanyPostController;

Route::post('/company', CompanyPostController::class);
