<?php

declare(strict_types=1);

namespace Medine\ERP\Item\Infrastructure;

use Illuminate\Support\Facades\DB;
use Medine\ERP\Item\Domain\Contracts\ItemRepository;
use Medine\ERP\Item\Domain\Entity\Item;
use Medine\ERP\Item\Domain\ValueObjects\ItemCategoryId;
use Medine\ERP\Item\Domain\ValueObjects\ItemCode;
use Medine\ERP\Item\Domain\ValueObjects\ItemCreatedAt;
use Medine\ERP\Item\Domain\ValueObjects\ItemId;
use Medine\ERP\Item\Domain\ValueObjects\ItemName;
use Medine\ERP\Item\Domain\ValueObjects\ItemState;
use Medine\ERP\Item\Domain\ValueObjects\ItemType;
use Medine\ERP\Item\Domain\ValueObjects\ItemUpdatedAt;

final class MySqlItemRepository implements ItemRepository
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
        $row = DB::table('products')->where('products.id', $itemId->value())->first();

        return !empty($row) ? Item::fromValues(
            new ItemId($row->id),
            new ItemCode($row->code),
            new ItemName($row->name),
            $row->reference,
            new ItemType($row->type),
            new ItemCategoryId($row->category_id),
            new ItemState($row->state),
            $row->company_id,
            $row->created_by,
            $row->updated_by,
            new ItemCreatedAt($row->created_at),
            new ItemUpdatedAt($row->updated_at)
        ) : null;
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
}
