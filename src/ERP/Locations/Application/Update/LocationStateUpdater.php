<?php

declare(strict_types=1);

namespace Medine\ERP\Locations\Application\Update;

use Medine\ERP\Locations\Domain\LocationRepository;
use Medine\ERP\Locations\Domain\Service\LocationFinder;
use Medine\ERP\Locations\Domain\Service\LocationNotExists;
use Medine\ERP\Locations\Domain\ValueObject\LocationId;

final class LocationStateUpdater
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
    public function __invoke(LocationStateUpdaterRequest $request): void
    {
        $location = ($this->finder)(new LocationId($request->id()));
        $location->changeState($request->state());

        $this->repository->update($location);
    }
}
