<?php

declare(strict_types=1);

namespace Tests\Unit\ERP\Product\Domain;

use Faker\Factory;
use Medine\ERP\Product\Application\Create\CreateProductRequest;
use Medine\ERP\Product\Domain\Entity\Product;
use Medine\ERP\Product\Domain\ValueObjects\ProductCategoryId;
use Medine\ERP\Product\Domain\ValueObjects\ProductCode;
use Medine\ERP\Product\Domain\ValueObjects\ProductId;
use Medine\ERP\Product\Domain\ValueObjects\ProductName;
use Medine\ERP\Product\Domain\ValueObjects\ProductState;
use Medine\ERP\Product\Domain\ValueObjects\ProductType;

final class ProductMother
{
    public static function create(
        ProductId $id,
        ProductCode $code,
        ProductName $name,
        string $reference,
        ProductType $type,
        ProductCategoryId $categoryId,
        ProductState $state,
        string $companyId,
        int $createdBy
    ): Product
    {
        return Product::create(
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

    public static function random(): Product
    {
        $faker = Factory::create();

        return self::create(
            ProductIdMother::random(),
            ProductCodeMother::random(),
            ProductNameMother::random(),
            $faker->text(50),
            ProductTypeIdMother::random(),
            ProductCategoryIdMother::random(),
            new ProductState('active'),
            $faker->uuid,
            $faker->numberBetween(1)
        );
    }

    public static function fromRequest(CreateProductRequest $request): Product
    {
        return self::create(
            ProductIdMother::create($request->id()),
            ProductCodeMother::create($request->code()),
            ProductNameMother::create($request->name()),
            $request->reference(),
            ProductTypeIdMother::create($request->type()),
            ProductCategoryIdMother::create($request->categoryId()),
            new ProductState($request->state()),
            $request->companyId(),
            $request->createdBy()
        );
    }
}
