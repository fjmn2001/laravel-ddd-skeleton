<?php

declare(strict_types=1);

namespace Tests\Unit\ERP\Locations\Application\Find;

use Medine\ERP\Locations\Application\Find\LocationFinderRequest;

final class LocationFinderRequestMother
{
    public static function withId(string $id): LocationFinderRequest
    {
        return self::create($id);
    }

    public static function create(string $id): LocationFinderRequest
    {
        return new LocationFinderRequest($id);
    }
}
