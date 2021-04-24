<?php

declare(strict_types=1);

namespace Medine\ERP\Locations\Application\Search;

final class LocationsSearcherResponse
{
    private $locations;

    public function __construct(LocationSearcherResponse ...$locations)
    {
        $this->locations = $locations;
    }

    public function locations(): array
    {
        return $this->locations;
    }
}
