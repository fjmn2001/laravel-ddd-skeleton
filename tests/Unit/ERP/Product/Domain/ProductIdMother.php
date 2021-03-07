<?php

declare(strict_types=1);

namespace Tests\Unit\ERP\Product\Domain;

use Faker\Factory;
use Medine\ERP\Product\Domain\ValueObjects\ProductId;
use Tests\Unit\ERP\Shared\Domain\UuidMother;

final class ProductIdMother
{
    public static function create(string $id): ProductId
    {
        return new ProductId($id);
    }

    public static function random(): ProductId
    {
        return self::create(
            UuidMother::random()
        );
    }
}
