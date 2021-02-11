<?php

declare(strict_types=1);

namespace Medine\ERP\PurchaseInvoices\Domain;

use Medine\ERP\PurchaseInvoices\Domain\ValueObject\PurchaseInvoiceId;

interface PurchaseInvoiceRepository
{
    public function save(PurchaseInvoice $invoice): void;

    public function find(PurchaseInvoiceId $id): ?PurchaseInvoice;
}
