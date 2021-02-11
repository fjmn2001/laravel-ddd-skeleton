<?php

declare(strict_types=1);

namespace Medine\ERP\PurchaseInvoices\Application\Find;

final class PurchaseInvoiceFinderRequest
{
    private $id;

    public function __construct(string $id)
    {
        $this->id = $id;
    }

    public function id(): string
    {
        return $this->id;
    }
}
