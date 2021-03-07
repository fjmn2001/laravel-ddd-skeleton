<?php

declare(strict_types=1);

namespace Medine\ERP\Product\Domain\Service;

use Medine\ERP\Product\Domain\ValueObjects\ProductId;

final class ProductNotExistsException extends \InvalidArgumentException
{

    public function __construct(ProductId $id)
    {
        $message = "The product with id {$id->value()} doesn't exist";
        parent::__construct($message);
    }
}
