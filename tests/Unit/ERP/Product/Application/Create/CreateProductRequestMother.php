<?php

declare(strict_types=1);

namespace Tests\Unit\ERP\Product\Application\Create;

use Faker\Factory;
use Medine\ERP\Product\Application\Create\CreateProductRequest;
use Medine\ERP\Product\Domain\ValueObjects\ProductCategoryId;
use Medine\ERP\Product\Domain\ValueObjects\ProductCode;
use Medine\ERP\Product\Domain\ValueObjects\ProductId;
use Medine\ERP\Product\Domain\ValueObjects\ProductName;
use Medine\ERP\Product\Domain\ValueObjects\ProductType;
use Tests\Unit\ERP\Product\Domain\ProductCategoryIdMother;
use Tests\Unit\ERP\Product\Domain\ProductCodeMother;
use Tests\Unit\ERP\Product\Domain\ProductIdMother;
use Tests\Unit\ERP\Product\Domain\ProductNameMother;
use Tests\Unit\ERP\Product\Domain\ProductTypeIdMother;

final class CreateProductRequestMother
{
    public static function create(
        ProductId $id,
        ProductCode $code,
        ProductName $name,
        string $reference,
        ProductType $type,
        ProductCategoryId $categoryId,
        string $state,
        string $companyId,
        int $createdBy
    ): CreateProductRequest
    {
        return new CreateProductRequest(
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

    public static function random(): CreateProductRequest
    {
        $faker = Factory::create();

        return self::create(
            ProductIdMother::random(),
            ProductCodeMother::random(),
            ProductNameMother::random(),
            $faker->text(50),
            ProductTypeIdMother::random(),
            ProductCategoryIdMother::random(),
            'active',
            $faker->uuid,
            $faker->numberBetween(1)
        );
    }

    public static function withId(string $id): CreateProductRequest
    {
        $faker = Factory::create();

        return self::create(
            ProductIdMother::create($id),
            ProductCodeMother::random(),
            ProductNameMother::random(),
            $faker->text(50),
            ProductTypeIdMother::random(),
            ProductCategoryIdMother::random(),
            'active',
            $faker->uuid,
            $faker->numberBetween(1)
        );
    }
}
