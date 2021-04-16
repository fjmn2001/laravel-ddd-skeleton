<?php

declare(strict_types=1);

namespace Medine\ERP\Locations\Domain;

use Medine\ERP\Locations\Domain\Entity\Location;
use Medine\ERP\Locations\Domain\ValueObject\LocationId;

interface LocationRepository
{
    public function save(Location $location): void;

    public function find(LocationId $id): ?Location;
}
