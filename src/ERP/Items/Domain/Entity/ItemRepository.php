<?php

declare(strict_types=1);

namespace Medine\ERP\Items\Domain\Entity;

interface ItemRepository
{
    public function save(Item $category): void;

    public function find(string $id): ?Item;

    public function update(Item $category): void;

    public function matching(\Medine\ERP\Shared\Domain\Criteria $criteria): array;

    public function count(\Medine\ERP\Shared\Domain\Criteria $criteria): int;
}
