<?php

declare(strict_types=1);

namespace Tests\Unit\ERP\Item\Application\Create;

use Faker\Factory;
use Medine\ERP\Item\Application\Create\CreateItemRequest;
use Medine\ERP\Item\Domain\ValueObjects\ItemCategoryId;
use Medine\ERP\Item\Domain\ValueObjects\ItemCode;
use Medine\ERP\Item\Domain\ValueObjects\ItemId;
use Medine\ERP\Item\Domain\ValueObjects\ItemName;
use Medine\ERP\Item\Domain\ValueObjects\ItemType;
use Tests\Unit\ERP\Item\Domain\ItemCategoryIdMother;
use Tests\Unit\ERP\Item\Domain\ItemCodeMother;
use Tests\Unit\ERP\Item\Domain\ItemIdMother;
use Tests\Unit\ERP\Item\Domain\ItemNameMother;
use Tests\Unit\ERP\Item\Domain\ItemTypeIdMother;

final class CreateItemRequestMother
{
    public static function create(
        ItemId $id,
        ItemCode $code,
        ItemName $name,
        string $reference,
        ItemType $type,
        ItemCategoryId $categoryId,
        string $state,
        string $companyId,
        int $createdBy
    ): CreateItemRequest
    {
        return new CreateItemRequest(
            $id->value(),
            $code->value(),
            $name->value(),
            $reference,
            $type->value(),
            $categoryId->value(),
            $state,
            $companyId,
            $createdBy
        );
    }

    public static function random(): CreateItemRequest
    {
        $faker = Factory::create();

        return self::create(
            ItemIdMother::random(),
            ItemCodeMother::random(),
            ItemNameMother::random(),
            $faker->text(50),
            ItemTypeIdMother::random(),
            ItemCategoryIdMother::random(),
            'active',
            $faker->uuid,
            $faker->numberBetween(1)
        );
    }

    public static function withId(string $id): CreateItemRequest
    {
        $faker = Factory::create();

        return self::create(
            ItemIdMother::create($id),
            ItemCodeMother::random(),
            ItemNameMother::random(),
            $faker->text(50),
            ItemTypeIdMother::random(),
            ItemCategoryIdMother::random(),
            'active',
            $faker->uuid,
            $faker->numberBetween(1)
        );
    }
}
