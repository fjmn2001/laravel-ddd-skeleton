<?php

declare(strict_types=1);

namespace Tests\Unit\ERP\Item\Application\Find;

use Medine\ERP\Item\Application\Find\ItemFinderRequest;
use Medine\ERP\Item\Domain\ValueObjects\ItemId;
use Tests\Unit\ERP\Item\Domain\ItemIdMother;

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
