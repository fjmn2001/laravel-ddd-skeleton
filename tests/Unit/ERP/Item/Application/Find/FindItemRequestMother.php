<?php

declare(strict_types=1);

namespace Tests\Unit\ERP\Item\Application\Find;

use Medine\ERP\Item\Application\Find\FindItemRequest;
use Medine\ERP\Item\Domain\ValueObjects\ItemId;
use Tests\Unit\ERP\Item\Domain\ItemIdMother;

final class FindItemRequestMother
{

    public static function create(ItemId $itemId): FindItemRequest
    {
        return new FindItemRequest($itemId->value());
    }

    public static function withId(string $itemId): FindItemRequest
    {
        return self::create(
            ItemIdMother::create($itemId)
        );
    }
}
