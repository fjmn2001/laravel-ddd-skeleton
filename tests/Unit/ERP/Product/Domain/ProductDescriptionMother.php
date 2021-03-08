<?php

declare(strict_types=1);

namespace Tests\Unit\ERP\Product\Domain;

use Medine\ERP\Product\Domain\ValueObjects\ProductDescription;
use Tests\Unit\ERP\Shared\Domain\LongTextMother;

final class ProductDescriptionMother
{
    public static function create(string $description): ProductDescription
    {
        return new ProductDescription($description);
    }

    public static function random(): ProductDescription
    {
        return self::create(
            LongTextMother::random()
        );
    }
}
