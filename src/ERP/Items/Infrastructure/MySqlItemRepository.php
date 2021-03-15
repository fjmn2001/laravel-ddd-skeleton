<?php

declare(strict_types=1);

namespace Medine\ERP\Items\Infrastructure;

use Illuminate\Support\Facades\DB;
use Medine\ERP\Items\Domain\Contracts\ItemRepository;
use Medine\ERP\Items\Domain\Entity\Item;
use Medine\ERP\Items\Domain\ValueObjects\ItemId;
use Medine\ERP\Shared\Domain\Criteria;
use Medine\ERP\Shared\Infrastructure\MySqlRepository;

final class MySqlItemRepository extends MySqlRepository implements ItemRepository
{

    public function save(Item $item): void
    {
        DB::table('products')->insert([
            'id' => $item->id()->value(),
            'code' => $item->code()->value(),
            'name' => $item->name()->value(),
            'reference' => $item->reference(),
            'type' => $item->type()->value(),
            'category_id' => $item->categoryId()->value(),
            'state' => $item->state()->value(),
            'company_id' => $item->companyId(),
            'created_by' => $item->createdBy(),
            'updated_by' => $item->updatedBy(),
            'created_at' => $item->createdAt()->value(),
            'updated_at' => $item->updatedAt()->value()
        ]);
    }

    public function find(ItemId $itemId): ?Item
    {
        return DB::table('products')
            ->where('products.id', $itemId->value())
            ->take(1)
            ->get()
            ->map($this->buildItem())
            ->first();
    }

    public function update(Item $item): void
    {
        DB::table('products')->where('products.id', $item->id()->value())->take(1)->update([
            'code' => $item->code()->value(),
            'name' => $item->name()->value(),
            'reference' => $item->reference(),
            'type' => $item->type()->value(),
            'category_id' => $item->categoryId()->value(),
            'state' => $item->state()->value(),
            'updated_by' => $item->updatedBy(),
            'updated_at' => $item->updatedAt()->value(),
        ]);
    }

    public function count(\Medine\ERP\Shared\Domain\Criteria $criteria): int
    {
        $query = DB::table('products');
        $query = (new MySqlItemFilters($query))($criteria);

        return (int)$query->count();
    }

    public function matching(Criteria $criteria): array
    {
        $query = DB::table('products');
        $query = (new MySqlItemFilters($query))($criteria);
        $query = $this->completeBuilder($criteria, $query);

        return $query->get()->map($this->buildItem())->toArray();
    }

    private function buildItem(): \Closure
    {
        return function ($row) {
            return Item::fromValues(
                $row->id,
                $row->code,
                $row->name,
                $row->reference,
                $row->type,
                $row->category_id,
                $row->state,
                $row->company_id,
                $row->created_by,
                $row->updated_by,
                $row->created_at,
                $row->updated_at
            );
        };
    }
}
