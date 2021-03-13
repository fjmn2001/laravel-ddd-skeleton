<?php

declare(strict_types=1);

namespace Tests\Unit\ERP\Product\Application\Update;

use Faker\Factory;
use Medine\ERP\Product\Application\Update\UpdateProductRequest;
use Medine\ERP\Product\Domain\ValueObjects\ProductCategoryId;
use Medine\ERP\Product\Domain\ValueObjects\ProductCode;
use Medine\ERP\Product\Domain\ValueObjects\ProductId;
use Medine\ERP\Product\Domain\ValueObjects\ProductName;
use Medine\ERP\Product\Domain\ValueObjects\ProductState;
use Medine\ERP\Product\Domain\ValueObjects\ProductType;
use Tests\Unit\ERP\Product\Domain\ProductCategoryIdMother;
use Tests\Unit\ERP\Product\Domain\ProductCodeMother;
use Tests\Unit\ERP\Product\Domain\ProductIdMother;
use Tests\Unit\ERP\Product\Domain\ProductNameMother;
use Tests\Unit\ERP\Product\Domain\ProductStateMother;
use Tests\Unit\ERP\Product\Domain\ProductTypeIdMother;

final class UpdateProductRequestMother
{
    public static function create(
        ProductId $id,
        ProductCode $code,
        ProductName $name,
        string $reference,
        ProductType $type,
        ProductCategoryId $categoryId,
        ProductState $state,
        int $updatedBy
    ): UpdateProductRequest
    {
        return new UpdateProductRequest (
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

    public static function withId(string $productId): UpdateProductRequest
    {
        $faker = Factory::create();

        return self::create(
            ProductIdMother::create($productId),
            ProductCodeMother::random(),
            ProductNameMother::random(),
            $faker->text(50),
            ProductTypeIdMother::random(),
            ProductCategoryIdMother::random(),
            ProductStateMother::random(),
            $faker->numberBetween(1)
        );
    }
}
