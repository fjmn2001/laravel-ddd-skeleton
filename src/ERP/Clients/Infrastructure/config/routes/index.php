<?php

use Illuminate\Support\Facades\Route;
use Medine\Apps\ERP\Backend\Controller\Clients\ClientPostController;

Route::post('/client', ClientPostController::class);
