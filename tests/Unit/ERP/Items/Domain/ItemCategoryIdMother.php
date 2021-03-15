<?php

declare(strict_types=1);

namespace Tests\Unit\ERP\Items\Domain;

use Medine\ERP\Items\Domain\ValueObjects\ItemCategoryId;
use Tests\Unit\ERP\Shared\Domain\UuidMother;

final class ItemCategoryIdMother
{
    public static function create(string $categoryId): ItemCategoryId
    {
        return new ItemCategoryId($categoryId);
    }

    public static function random(): ItemCategoryId
    {
        return self::create(
            UuidMother::random()
        );
    }
}
