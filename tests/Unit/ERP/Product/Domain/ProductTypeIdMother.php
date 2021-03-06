<?php

declare(strict_types=1);

namespace Tests\Unit\ERP\Product\Domain;

use Medine\ERP\Product\Domain\ValueObjects\ProductType;
use Tests\Unit\ERP\Shared\Domain\UuidMother;

final class ProductTypeIdMother
{
    public static function create(string $typeId): ProductType
    {
        return new ProductType($typeId);
    }

    public static function random(): ProductType
    {
        return self::create(
            UuidMother::random()
        );
    }
}
