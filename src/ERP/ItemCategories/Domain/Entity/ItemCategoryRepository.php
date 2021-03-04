<?php

declare(strict_types=1);

namespace Medine\ERP\ItemCategories\Domain\Entity;

interface ItemCategoryRepository
{
    public function save(ItemCategory $category): void;
}
