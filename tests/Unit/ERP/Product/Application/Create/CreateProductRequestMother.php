<?php

declare(strict_types=1);

namespace Tests\Unit\ERP\Product\Application\Create;

use Medine\ERP\Product\Application\Create\CreateProductRequest;
use Medine\ERP\Product\Domain\ValueObjects\ProductCategory;
use Medine\ERP\Product\Domain\ValueObjects\ProductCode;
use Medine\ERP\Product\Domain\ValueObjects\ProductDescription;
use Medine\ERP\Product\Domain\ValueObjects\ProductId;
use Medine\ERP\Product\Domain\ValueObjects\ProductName;
use Medine\ERP\Product\Domain\ValueObjects\ProductType;
use Tests\Unit\ERP\Product\Domain\ProductCategoryIdMother;
use Tests\Unit\ERP\Product\Domain\ProductCodeMother;
use Tests\Unit\ERP\Product\Domain\ProductDescriptionMother;
use Tests\Unit\ERP\Product\Domain\ProductIdMother;
use Tests\Unit\ERP\Product\Domain\ProductNameMother;
use Tests\Unit\ERP\Product\Domain\ProductTypeIdMother;

final class CreateProductRequestMother
{
    public static function create(
        ProductId $id,
        ProductCode $code,
        ProductName $name,
        ProductCategory $categoryId,
        ProductDescription $description,
        ProductType $typeId
    ): CreateProductRequest
    {
        return new CreateProductRequest(
            $id->value(),
            $code->value(),
            $name->value(),
            $categoryId->value(),
            $description->value(),
            $typeId->value()
        );
    }

    public static function random(): CreateProductRequest
    {
        return self::create(
            ProductIdMother::random(),
            ProductCodeMother::random(),
            ProductNameMother::random(),
            ProductCategoryIdMother::random(),
            ProductDescriptionMother::random(),
            ProductTypeIdMother::random()
        );
    }

    public static function withId(string $id): CreateProductRequest
    {
        return self::create(
            ProductIdMother::create($id),
            ProductCodeMother::random(),
            ProductNameMother::random(),
            ProductCategoryIdMother::random(),
            ProductDescriptionMother::random(),
            ProductTypeIdMother::random()
        );
    }
}
