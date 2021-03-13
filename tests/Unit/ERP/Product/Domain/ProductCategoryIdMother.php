<?php

declare(strict_types=1);

namespace Tests\Unit\ERP\Product\Domain;

use Medine\ERP\Product\Domain\ValueObjects\ProductCategoryId;
use Tests\Unit\ERP\Shared\Domain\UuidMother;

final class ProductCategoryIdMother
{
    public static function create(string $categoryId): ProductCategoryId
    {
        return new ProductCategoryId($categoryId);
    }

    public static function random(): ProductCategoryId
    {
        return self::create(
            UuidMother::random()
        );
    }
}
