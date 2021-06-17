<?php

declare(strict_types=1);

namespace Tests\Unit\ERP\Locations\Application\Search;

use Medine\ERP\Locations\Application\Search\LocationCountSearcherRequest;

final class LocationCountSearcherRequestMother
{
    public static function random(): LocationCountSearcherRequest
    {
        $filters = [];
        return self::create($filters);
    }

    public static function create(array $filters): LocationCountSearcherRequest
    {
        return new LocationCountSearcherRequest($filters);
    }
}
