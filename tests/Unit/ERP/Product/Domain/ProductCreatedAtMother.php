<?php

declare(strict_types=1);

namespace Tests\Unit\ERP\Product\Domain;

use Medine\ERP\Product\Domain\ValueObjects\ProductCreatedAt;

final class ProductCreatedAtMother
{
    public static function create(string $createdAt): ProductCreatedAt
    {
        return new ProductCreatedAt($createdAt);
    }

    public static function random(): ProductCreatedAt
    {
        return self::create(
            SelectMother::fromValues(self::$status)
        );
    }
}
