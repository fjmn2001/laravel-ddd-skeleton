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

    public function find(string $id): ?ItemCategory
    {
        return DB::table('item_categories')
            ->where('id', $id)
            ->take(1)
            ->get()
            ->map($this->buildItemCategory())
            ->first();
    }

    public function update(ItemCategory $category): void
    {
        DB::table('item_categories')
            ->where('id', $category->id())
            ->take(1)
            ->update([
                'name' => $category->name(),
                'description' => $category->description(),
                'state' => $category->state(),
                'updated_by' => $category->updatedBy(),
                'updated_at' => $category->updatedAt()
            ]);
    }

    public function matching(\Medine\ERP\Shared\Domain\Criteria $criteria): array
    {
        $query = DB::table('item_categories');
        $query = (new MySqlItemCategoryFilters($query))($criteria);
        $query = $this->completeBuilder($criteria, $query);

        return $query->get()->map($this->buildItemCategory())->toArray();
    }

    private function buildItemCategory(): \Closure
    {
        return function ($row) {
            return ItemCategory::fromDatabase(
                $row->id,
                $row->name,
                $row->description,
                $row->state,
                $row->created_by,
                $row->updated_by,
                $row->company_id,
                $row->created_at,
                $row->updated_at
            );
        };
    }
}
