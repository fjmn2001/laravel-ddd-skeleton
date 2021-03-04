<?php

declare(strict_types=1);

namespace Medine\ERP\ItemCategories\Domain\Entity;

interface ItemCategoryRepository
{
    public function save(ItemCategory $category): void;

    public function find(string $id): ?ItemCategory;

    public function update(ItemCategory $category): void;
}
