<?php

declare(strict_types=1);

namespace Tests\Unit\ERP\Product\Application\Update;

use Medine\ERP\Product\Application\Update\UpdateProductRequest;
use Medine\ERP\Product\Domain\ValueObjects\ProductCategory;
use Medine\ERP\Product\Domain\ValueObjects\ProductCode;
use Medine\ERP\Product\Domain\ValueObjects\ProductDescription;
use Medine\ERP\Product\Domain\ValueObjects\ProductId;
use Medine\ERP\Product\Domain\ValueObjects\ProductName;
use Medine\ERP\Product\Domain\ValueObjects\ProductState;
use Medine\ERP\Product\Domain\ValueObjects\ProductType;
use Tests\Unit\ERP\Product\Domain\ProductCategoryIdMother;
use Tests\Unit\ERP\Product\Domain\ProductCodeMother;
use Tests\Unit\ERP\Product\Domain\ProductDescriptionMother;
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
        ProductCategory $categoryId,
        ProductDescription $description,
        ProductType $typeId,
        ProductState $state
    ): UpdateProductRequest
    {
        return new UpdateProductRequest (
            $id->value(),
            $code->value(),
            $name->value(),
            $categoryId->value(),
            $description->value(),
            $typeId->value(),
            $state->value()
        );
    }

    public static function withId(string $productId): UpdateProductRequest
    {
        return self::create(
            ProductIdMother::create($productId),
            ProductCodeMother::random(),
            ProductNameMother::random(),
            ProductCategoryIdMother::random(),
            ProductDescriptionMother::random(),
            ProductTypeIdMother::random(),
            ProductStateMother::random()
        );
    }
}
