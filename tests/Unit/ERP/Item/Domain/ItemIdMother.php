<?php

declare(strict_types=1);

namespace Tests\Unit\ERP\Item\Domain;

use Medine\ERP\Item\Domain\ValueObjects\ItemId;
use Tests\Unit\ERP\Shared\Domain\UuidMother;

final class ItemIdMother
{
    public static function create(string $id): ItemId
    {
        return new ItemId($id);
    }

    public static function random(): ItemId
    {
        return self::create(
            UuidMother::random()
        );
    }
}
