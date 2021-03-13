<?php

declare(strict_types=1);

namespace Tests\Unit\ERP\Item\Domain;

use Faker\Factory;
use Medine\ERP\Item\Application\Create\ItemCreatorRequest;
use Medine\ERP\Item\Domain\Entity\Item;
use Medine\ERP\Item\Domain\ValueObjects\ItemCategoryId;
use Medine\ERP\Item\Domain\ValueObjects\ItemCode;
use Medine\ERP\Item\Domain\ValueObjects\ItemId;
use Medine\ERP\Item\Domain\ValueObjects\ItemName;
use Medine\ERP\Item\Domain\ValueObjects\ItemState;
use Medine\ERP\Item\Domain\ValueObjects\ItemType;

final class ItemMother
{
    public static function create(
        ItemId $id,
        ItemCode $code,
        ItemName $name,
        string $reference,
        ItemType $type,
        ItemCategoryId $categoryId,
        ItemState $state,
        string $companyId,
        int $createdBy
    ): Item
    {
        return Item::create(
            $id,
            $code,
            $name,
            $reference,
            $type,
            $categoryId,
            $state,
            $companyId,
            $createdBy
        );
    }

    public static function random(): Item
    {
        $faker = Factory::create();

        return self::create(
            ItemIdMother::random(),
            ItemCodeMother::random(),
            ItemNameMother::random(),
            $faker->text(50),
            ItemTypeIdMother::random(),
            ItemCategoryIdMother::random(),
            new ItemState('active'),
            $faker->uuid,
            $faker->numberBetween(1)
        );
    }

    public static function fromRequest(ItemCreatorRequest $request): Item
    {
        return self::create(
            ItemIdMother::create($request->id()),
            ItemCodeMother::create($request->code()),
            ItemNameMother::create($request->name()),
            $request->reference(),
            ItemTypeIdMother::create($request->type()),
            ItemCategoryIdMother::create($request->categoryId()),
            new ItemState($request->state()),
            $request->companyId(),
            $request->createdBy()
        );
    }
}
