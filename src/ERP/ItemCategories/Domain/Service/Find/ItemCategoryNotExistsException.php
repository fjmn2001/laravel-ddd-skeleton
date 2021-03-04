<?php

declare(strict_types=1);

namespace Medine\ERP\ItemCategories\Domain\Service\Find;

final class ItemCategoryNotExistsException extends \RuntimeException
{
    public function __construct(string $id)
    {
        parent::__construct("ItemCategory {$id} do not exists.");
    }
}
