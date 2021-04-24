<?php

declare(strict_types=1);

namespace Medine\ERP\Locations\Application\Find;

use Medine\ERP\Locations\Domain\LocationRepository;
use Medine\ERP\Locations\Domain\ValueObject\LocationId;

final class LocationFinder
{
    private $repository;

    public function __construct(LocationRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(LocationFinderRequest $request)
    {
        $location = $this->repository->find(new LocationId($request->id()));

        if (null === $location) {
            throw new LocationNotExists($request->id());
        }

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
