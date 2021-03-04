<?php

declare(strict_types=1);

namespace Medine\ERP\ItemCategories\Application\Find;

final class ItemCategoryFinderRequest
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
