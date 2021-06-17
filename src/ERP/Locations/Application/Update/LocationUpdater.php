<?php

declare(strict_types=1);

namespace Medine\ERP\Locations\Application\Update;

use Medine\ERP\Locations\Domain\LocationRepository;
use Medine\ERP\Locations\Domain\Service\LocationFinder;
use Medine\ERP\Locations\Domain\Service\LocationNotExists;
use Medine\ERP\Locations\Domain\ValueObject\LocationId;

final class LocationUpdater
{

    private $repository;
    private $finder;

    public function __construct(LocationRepository $repository)
    {
        $this->repository = $repository;
        $this->finder = new LocationFinder($repository);
    }

    /**
     * @throws LocationNotExists
     */
    public function __invoke(LocationUpdaterRequest $request): void
    {
        $location = ($this->finder)(new LocationId($request->id()));

        $location->changeCode($request->code());
        $location->changeName($request->name());
        $location->changeMainContact($request->mainContact());
        $location->changeBarcode($request->barcode());
        $location->changeAddress($request->address());
        $location->changeItemState($request->itemState());
        $location->changeState($request->state());
        $location->changeUpdatedBy($request->updatedBy());

        $this->repository->update($location);
    }
}
