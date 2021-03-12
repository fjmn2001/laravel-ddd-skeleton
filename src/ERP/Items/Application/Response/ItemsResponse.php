<?php

declare(strict_types=1);

namespace Medine\ERP\Items\Application\Response;

final class ItemsResponse
{
    private $categories;

    public function __construct(ItemResponse ...$categories)
    {
        $this->categories = $categories;
    }

    public function categories(): array
    {
        return $this->categories;
    }
}
