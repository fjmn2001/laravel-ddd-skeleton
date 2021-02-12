<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Medine\ERP\PurchaseInvoices\Infrastructure\Controllers\PurchaseInvoiceGetController;
use Medine\ERP\PurchaseInvoices\Infrastructure\Controllers\PurchaseInvoicePostController;
use Medine\ERP\PurchaseInvoices\Infrastructure\Controllers\PurchaseInvoicePutController;

Route::middleware('auth:api')->group(function () {
    Route::post('/purchase_invoices', PurchaseInvoicePostController::class);
    Route::get('/purchase_invoices/{id}', PurchaseInvoiceGetController::class);
    Route::put('/purchase_invoices/{id}', PurchaseInvoicePutController::class);
});
