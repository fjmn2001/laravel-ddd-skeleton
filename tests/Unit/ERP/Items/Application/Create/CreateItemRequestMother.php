<?php

declare(strict_types=1);

namespace Tests\Unit\ERP\Items\Application\Create;

use Faker\Factory;
use Medine\ERP\Items\Application\Create\ItemCreatorRequest;
use Medine\ERP\Items\Domain\ValueObjects\ItemCategoryId;
use Medine\ERP\Items\Domain\ValueObjects\ItemCode;
use Medine\ERP\Items\Domain\ValueObjects\ItemId;
use Medine\ERP\Items\Domain\ValueObjects\ItemName;
use Medine\ERP\Items\Domain\ValueObjects\ItemType;
use Tests\Unit\ERP\Items\Domain\ItemCategoryIdMother;
use Tests\Unit\ERP\Items\Domain\ItemCodeMother;
use Tests\Unit\ERP\Items\Domain\ItemIdMother;
use Tests\Unit\ERP\Items\Domain\ItemNameMother;
use Tests\Unit\ERP\Items\Domain\ItemTypeIdMother;

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
    ): ItemCreatorRequest
    {
        return new ItemCreatorRequest(
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

    public static function random(): ItemCreatorRequest
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

    public static function withId(string $id): ItemCreatorRequest
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
