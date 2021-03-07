<?php

declare(strict_types=1);

namespace Tests\Unit\ERP\Product\Domain;


use Medine\ERP\Product\Domain\ValueObjects\ProductState;
use Tests\Unit\ERP\Shared\Domain\SelectMother;

final class ProductStateMother
{
    private static $status = ['activo', 'inactivo'];

    public static function create(string $state): ProductState
    {
        return new ProductState($state);
    }

    public static function random(): ProductState
    {
        return self::create(
            SelectMother::fromValues(self::$status)
        );
    }
}
