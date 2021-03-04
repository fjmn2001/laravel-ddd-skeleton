<?php

declare(strict_types=1);

namespace Medine\ERP\ItemCategories\Infrastructure\Persistence;

use Illuminate\Support\Facades\DB;
use Medine\ERP\ItemCategories\Domain\Entity\ItemCategory;
use Medine\ERP\Shared\Infrastructure\MySqlRepository;

final class MySqlItemCategoryRepository extends MySqlRepository implements \Medine\ERP\ItemCategories\Domain\Entity\ItemCategoryRepository
{

    public function save(ItemCategory $category): void
    {
        DB::table('item_categories')->insert([
            'id' => $category->id(),
            'name' => $category->name(),
            'description' => $category->description(),
            'state' => $category->state(),
            'created_by' => $category->createdBy(),
            'updated_by' => $category->updatedBy(),
            'company_id' => $category->companyId(),
            'created_at' => $category->createdAt(),
            'updated_at' => $category->updatedAt()
        ]);
    }
}
