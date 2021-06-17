<?php

declare(strict_types=1);

namespace Medine\ERP\Locations\Application\Create;

use Medine\ERP\Locations\Domain\Entity\Location;
use Medine\ERP\Locations\Domain\LocationRepository;

final class LocationCreator
{
    private $repository;

    public function __construct(LocationRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(LocationCreatorRequest $request)
    {
        $location = Location::create(
            $request->id(),
            $request->code(),
            $request->name(),
            $request->mainContact(),
            $request->barcode(),
            $request->address(),
            $request->itemState(),
            $request->state(),
            $request->companyId(),
            $request->createdBy()
        );

        $this->repository->save($location);
    }

}
