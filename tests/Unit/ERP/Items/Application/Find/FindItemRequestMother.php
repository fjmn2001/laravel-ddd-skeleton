<?php

declare(strict_types=1);

namespace Tests\Unit\ERP\Items\Application\Find;

use Medine\ERP\Items\Application\Find\ItemFinderRequest;
use Medine\ERP\Items\Domain\ValueObjects\ItemId;
use Tests\Unit\ERP\Items\Domain\ItemIdMother;

final class FindItemRequestMother
{

    public static function create(ItemId $itemId): ItemFinderRequest
    {
        return new ItemFinderRequest($itemId->value());
    }

    public static function withId(string $itemId): ItemFinderRequest
    {
        return self::create(
            ItemIdMother::create($itemId)
        );
    }
}
