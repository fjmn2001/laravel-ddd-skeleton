<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Medine\Apps\ERP\Backend\Controller\PurchaseInvoices\PurchaseInvoicePostController;

Route::middleware('auth:api')->group(function () {
    Route::post('/purchase_invoices', PurchaseInvoicePostController::class);
});
