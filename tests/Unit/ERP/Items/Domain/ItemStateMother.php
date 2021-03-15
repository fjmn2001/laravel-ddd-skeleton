<?php

declare(strict_types=1);

namespace Tests\Unit\ERP\Items\Domain;


use Medine\ERP\Items\Domain\ValueObjects\ItemState;
use Tests\Unit\ERP\Shared\Domain\SelectMother;

final class ItemStateMother
{
    private static $status = ['activo', 'inactivo'];

    public static function create(string $state): ItemState
    {
        return new ItemState($state);
    }

    public static function random(): ItemState
    {
        return self::create(
            SelectMother::fromValues(self::$status)
        );
    }
}
