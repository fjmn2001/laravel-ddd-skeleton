<?php

declare(strict_types=1);

namespace Medine\ERP\Items\Infrastructure\Persistence;

use Illuminate\Support\Facades\DB;
use Medine\ERP\Items\Domain\Entity\Item;
use Medine\ERP\Shared\Infrastructure\MySqlRepository;

final class MySqlItemRepository extends MySqlRepository implements \Medine\ERP\Items\Domain\Entity\ItemRepository
{

    public function save(Item $category): void
    {
        DB::table('items')->insert([
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

    public function find(string $id): ?Item
    {
        return DB::table('items')
            ->where('id', $id)
            ->take(1)
            ->get()
            ->map($this->buildItem())
            ->first();
    }

    public function update(Item $category): void
    {
        DB::table('items')
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
        $query = DB::table('items');
        $query = (new MySqlItemFilters($query))($criteria);
        $query = $this->completeBuilder($criteria, $query);

        return $query->get()->map($this->buildItem())->toArray();
    }

    public function count(\Medine\ERP\Shared\Domain\Criteria $criteria): int
    {
        $query = DB::table('items');
        $query = (new MySqlItemFilters($query))($criteria);

        return (int)$query->count();
    }

    private function buildItem(): \Closure
    {
        return function ($row) {
            return Item::fromDatabase(
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
