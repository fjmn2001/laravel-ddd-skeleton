<?php

declare(strict_types=1);

namespace Tests\Unit\ERP\Product\Domain;

use Medine\ERP\Product\Domain\ValueObjects\ProductName;
use Tests\Unit\ERP\Shared\Domain\NameMother;

final class ProductNameMother
{
    public static function create(string $name): ProductName
    {
        return new ProductName($name);
    }

    public static function random(): ProductName
    {
        return self::create(
            NameMother::random()
        );
    }
}
