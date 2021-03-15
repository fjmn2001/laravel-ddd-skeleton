<?php

declare(strict_types=1);

namespace Tests\Unit\ERP\Items\Infrastructure;

use Medine\ERP\Items\Domain\Contracts\ItemRepository;
use Medine\ERP\Items\Domain\Entity\Item;
use Medine\ERP\Items\Domain\ValueObjects\ItemId;
use Medine\ERP\Shared\Domain\Criteria;

final class InMemoryItemRepository implements ItemRepository
{

    public function save(Item $item): void
    {
        // TODO: Implement create() method.
    }

    public function find(ItemId $itemId): ?Item
    {
        return null;
    }

    public function update(Item $item): void
    {
        // TODO: Implement update() method.
    }

    public function count(Criteria $criteria): int
    {
        // TODO: Implement count() method.
    }
}
