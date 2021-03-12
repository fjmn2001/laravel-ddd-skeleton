<?php

declare(strict_types=1);

namespace Medine\ERP\Items\Domain\Service\Find;

final class ItemNotExistsException extends \RuntimeException
{
    public function __construct(string $id)
    {
        parent::__construct("Item {$id} do not exists.");
    }
}
