<?php

declare(strict_types=1);

namespace Tests\Unit\ERP\Locations\Infrastructure;

use Medine\ERP\Locations\Domain\Entity\Location;
use Medine\ERP\Locations\Domain\LocationRepository;

final class InMemoryLocationRepository implements LocationRepository
{

    public function save(Location $location): void
    {
        // TODO: Implement create() method.
    }
}
