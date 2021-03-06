<?php

declare(strict_types=1);

namespace Tests\Unit\ERP\Product\Application\Find;

use Medine\ERP\Product\Application\Find\FindProductRequest;
use Medine\ERP\Product\Domain\ValueObjects\ProductId;
use Tests\Unit\ERP\Product\Domain\ProductIdMother;

final class FindProductRequestMother
{

    public static function create(ProductId $productId): FindProductRequest
    {
        return new FindProductRequest($productId->value());
    }

    public static function withId(string $productId): FindProductRequest
    {
        return self::create(
            ProductIdMother::create($productId)
        );
    }
}
