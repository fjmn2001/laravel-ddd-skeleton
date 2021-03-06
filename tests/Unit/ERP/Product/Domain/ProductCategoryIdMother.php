<?php

declare(strict_types=1);

namespace Tests\Unit\ERP\Product\Domain;

use Medine\ERP\Product\Domain\ValueObjects\ProductCategory;
use Tests\Unit\ERP\Shared\Domain\UuidMother;

final class ProductCategoryIdMother
{
    public static function create(string $categoryId): ProductCategory
    {
        return new ProductCategory($categoryId);
    }

    public static function random(): ProductCategory
    {
        return self::create(
            UuidMother::random()
        );
    }
}
