<?php

declare(strict_types=1);

namespace Tests\Unit\ERP\Items\Domain;

use Medine\ERP\Items\Domain\ValueObjects\ItemName;
use Tests\Unit\ERP\Shared\Domain\NameMother;

final class ItemNameMother
{
    public static function create(string $name): ItemName
    {
        return new ItemName($name);
    }

    public static function random(): ItemName
    {
        return self::create(
            NameMother::random()
        );
    }
}
