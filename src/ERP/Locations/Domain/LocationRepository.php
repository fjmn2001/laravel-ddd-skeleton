<?php

declare(strict_types=1);

namespace Medine\ERP\Locations\Domain;

use Medine\ERP\Locations\Domain\Entity\Location;

interface LocationRepository
{
    public function save(Location $location): void;
}
