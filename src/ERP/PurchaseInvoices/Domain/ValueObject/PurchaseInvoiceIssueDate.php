<?php

declare(strict_types=1);

namespace Medine\ERP\PurchaseInvoices\Domain\ValueObject;

use Medine\ERP\Shared\Domain\ValueObjects\DateTimeValueObject;

final class PurchaseInvoiceIssueDate extends DateTimeValueObject
{
    public function __construct(string $date)
    {
        parent::__construct((string)self::createFromFormat('d/m/Y', $date));
    }
}
