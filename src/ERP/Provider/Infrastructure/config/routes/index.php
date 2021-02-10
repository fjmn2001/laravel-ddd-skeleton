<?php

use Illuminate\Support\Facades\Route;
use Medine\Apps\ERP\Backend\Controller\Provider\ProviderPostController;

Route::middleware('auth:api')->group(function (){
    Route::post('/provider', ProviderPostController::class);
});
