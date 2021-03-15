<?php

declare(strict_types=1);

namespace Tests\Unit\ERP\Items\Domain;

use Medine\ERP\Items\Domain\ValueObjects\ItemType;
use Tests\Unit\ERP\Shared\Domain\UuidMother;

final class ItemTypeIdMother
{
    public static function create(string $typeId): ItemType
    {
        return new ItemType($typeId);
    }

    public static function random(): ItemType
    {
        return self::create(
            UuidMother::random()
        );
    }
}
