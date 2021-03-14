<?php

declare(strict_types=1);

namespace Medine\ERP\Item\Domain\Service;

use Medine\ERP\Item\Domain\ValueObjects\ItemId;

final class ItemNotExistsException extends \InvalidArgumentException
{

    public function __construct(ItemId $id)
    {
        $message = "The item with id {$id->value()} doesn't exist";
        parent::__construct($message);
    }
}
