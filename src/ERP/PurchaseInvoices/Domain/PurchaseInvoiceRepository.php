<?php

declare(strict_types=1);

namespace Medine\ERP\PurchaseInvoices\Domain;

interface PurchaseInvoiceRepository
{
    public function save(PurchaseInvoice $invoice): void;
}
