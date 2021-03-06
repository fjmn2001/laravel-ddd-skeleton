<?php

declare(strict_types=1);

namespace Tests\Unit\ERP\Product\Domain;

use Medine\ERP\Product\Application\Create\CreateProductRequest;
use Medine\ERP\Product\Domain\Entity\Product;
use Medine\ERP\Product\Domain\ValueObjects\ProductCategory;
use Medine\ERP\Product\Domain\ValueObjects\ProductCode;
use Medine\ERP\Product\Domain\ValueObjects\ProductDescription;
use Medine\ERP\Product\Domain\ValueObjects\ProductId;
use Medine\ERP\Product\Domain\ValueObjects\ProductName;
use Medine\ERP\Product\Domain\ValueObjects\ProductType;

final class ProductMother
{

    public static function create(
        ProductId $id,
        ProductCode $code,
        ProductName $name,
        ProductCategory $categoryId,
        ProductDescription $description,
        ProductType $typeId
    ): Product
    {
        return Product::create(
            $id,
            $code,
            $name,
            $categoryId,
            $description,
            $typeId
        );
    }

    public static function random(): Product
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

    public static function fromRequest(CreateProductRequest $request): Product
    {
        return self::create(
            ProductIdMother::create($request->id()),
            ProductCodeMother::create($request->code()),
            ProductNameMother::create($request->name()),
            ProductCategoryIdMother::create($request->categoryId()),
            ProductDescriptionMother::create($request->description()),
            ProductTypeIdMother::create($request->typeId())
        );
    }
}
