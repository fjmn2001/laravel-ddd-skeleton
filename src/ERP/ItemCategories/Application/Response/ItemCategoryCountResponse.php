<?php

declare(strict_types=1);

namespace Medine\ERP\ItemCategories\Application\Response;

final class ItemCategoryCountResponse
{

    private $count;

    public function __construct(int $count)
    {
        $this->count = $count;
    }

    public function count(): int
    {
        return $this->count;
    }
}
