<?php

declare(strict_types=1);

namespace Tests\Unit\ERP\Items\Infrastructure\Persistence;

use Medine\ERP\Items\Domain\Entity\Item;
use Medine\ERP\Items\Domain\Entity\ItemRepository;

final class InMemoryItemRepository implements ItemRepository
{
    public function save(Item $category): void
    {
        // TODO: Implement save() method.
    }

    public function find(string $id): ?Item
    {
        // TODO: Implement find() method.
    }

    public function update(Item $category): void
    {
        // TODO: Implement update() method.
    }

    public function matching(\Medine\ERP\Shared\Domain\Criteria $criteria): array
    {
        // TODO: Implement matching() method.
    }

    public function count(\Medine\ERP\Shared\Domain\Criteria $criteria): int
    {
        // TODO: Implement count() method.
    }
}
