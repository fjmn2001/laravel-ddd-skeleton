<?php

declare(strict_types=1);

namespace Medine\ERP\Locations\Application\Find;

use Medine\ERP\Locations\Domain\LocationRepository;
use Medine\ERP\Locations\Domain\Service\LocationFinder as DomainLocationFinder;
use Medine\ERP\Locations\Domain\Service\LocationNotExists;
use Medine\ERP\Locations\Domain\ValueObject\LocationId;

final class LocationFinder
{
    private $finder;

    public function __construct(LocationRepository $repository)
    {
        $this->finder = new DomainLocationFinder($repository);
    }

    /**
     * @throws LocationNotExists
     */
    public function __invoke(LocationFinderRequest $request): LocationFinderResponse
    {
        $location = ($this->finder)(new LocationId($request->id()));

        return new LocationFinderResponse(
            $location->id()->value(),
            $location->code()->value(),
            $location->name()->value(),
            $location->mainContact()->value(),
            $location->barcode()->value(),
            $location->address()->value(),
            $location->itemState()->value(),
            $location->state()->value(),
            $location->companyId()->value()
        );
    }
}
