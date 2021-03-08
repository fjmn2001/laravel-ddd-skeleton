<?php

declare(strict_types=1);

namespace Tests\Unit\ERP\Product\Domain;

use Medine\ERP\Product\Domain\ValueObjects\ProductCode;
use Tests\Unit\ERP\Shared\Domain\CodeMother;

final class ProductCodeMother
{
    public static function create(string $code): ProductCode
    {
        return new ProductCode($code);
    }

    public static function random(): ProductCode
    {
        return self::create(
            CodeMother::random()
        );
    }
}
