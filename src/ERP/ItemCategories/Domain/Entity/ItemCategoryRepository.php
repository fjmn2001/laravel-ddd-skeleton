<?php

declare(strict_types=1);

namespace Medine\ERP\ItemCategories\Domain\Entity;

interface ItemCategoryRepository
{
    public function save(ItemCategory $category): void;

    public function find(string $id): ?ItemCategory;

    public function update(ItemCategory $category): void;

    public function matching(\Medine\ERP\Shared\Domain\Criteria $criteria): array;

    public function count(\Medine\ERP\Shared\Domain\Criteria $criteria): int;
}
