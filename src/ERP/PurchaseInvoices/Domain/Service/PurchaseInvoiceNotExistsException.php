<?php

declare(strict_types=1);

namespace Medine\ERP\PurchaseInvoices\Domain\Service;

use Medine\ERP\PurchaseInvoices\Domain\ValueObject\PurchaseInvoiceId;

final class PurchaseInvoiceNotExistsException extends \RuntimeException
{
    public function __construct(PurchaseInvoiceId $id)
    {
        $message = "The rol with id: {$id->value()} do not exists.";
        parent::__construct($message);
    }
}
