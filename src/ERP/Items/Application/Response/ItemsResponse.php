<?php

declare(strict_types=1);

namespace Medine\ERP\Items\Application\Response;

final class ItemsResponse
{
    private $items;

    public function __construct(ItemResponse ...$items)
    {
        $this->items = $items;
    }

    public function items(): array
    {
        return $this->items;
    }
}
