<?php

declare(strict_types=1);

namespace Tests\Unit\ERP\Item\Application\Update;

use Faker\Factory;
use Medine\ERP\Item\Application\Update\ItemUpdaterRequest;
use Medine\ERP\Item\Domain\ValueObjects\ItemCategoryId;
use Medine\ERP\Item\Domain\ValueObjects\ItemCode;
use Medine\ERP\Item\Domain\ValueObjects\ItemId;
use Medine\ERP\Item\Domain\ValueObjects\ItemName;
use Medine\ERP\Item\Domain\ValueObjects\ItemState;
use Medine\ERP\Item\Domain\ValueObjects\ItemType;
use Tests\Unit\ERP\Item\Domain\ItemCategoryIdMother;
use Tests\Unit\ERP\Item\Domain\ItemCodeMother;
use Tests\Unit\ERP\Item\Domain\ItemIdMother;
use Tests\Unit\ERP\Item\Domain\ItemNameMother;
use Tests\Unit\ERP\Item\Domain\ItemStateMother;
use Tests\Unit\ERP\Item\Domain\ItemTypeIdMother;

final class UpdateItemRequestMother
{
    public static function create(
        ItemId $id,
        ItemCode $code,
        ItemName $name,
        string $reference,
        ItemType $type,
        ItemCategoryId $categoryId,
        ItemState $state,
        int $updatedBy
    ): ItemUpdaterRequest
    {
        return new ItemUpdaterRequest (
            $id->value(),
            $code->value(),
            $name->value(),
            $reference,
            $type->value(),
            $categoryId->value(),
            $state->value(),
            $updatedBy
        );
    }

    public static function withId(string $itemId): ItemUpdaterRequest
    {
        $faker = Factory::create();

        return self::create(
            ItemIdMother::create($itemId),
            ItemCodeMother::random(),
            ItemNameMother::random(),
            $faker->text(50),
            ItemTypeIdMother::random(),
            ItemCategoryIdMother::random(),
            ItemStateMother::random(),
            $faker->numberBetween(1)
        );
    }
}
