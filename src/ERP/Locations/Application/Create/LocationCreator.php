<?php

declare(strict_types=1);

namespace Medine\ERP\Locations\Application\Create;

use Medine\ERP\Locations\Domain\Entity\Location;
use Medine\ERP\Locations\Domain\LocationRepository;
use Medine\ERP\Locations\Domain\ValueObject\LocationBarcode;
use Medine\ERP\Locations\Domain\ValueObject\LocationCode;
use Medine\ERP\Locations\Domain\ValueObject\LocationCompanyId;
use Medine\ERP\Locations\Domain\ValueObject\LocationDirection;
use Medine\ERP\Locations\Domain\ValueObject\LocationId;
use Medine\ERP\Locations\Domain\ValueObject\LocationItemState;
use Medine\ERP\Locations\Domain\ValueObject\LocationMainContact;
use Medine\ERP\Locations\Domain\ValueObject\LocationName;
use Medine\ERP\Locations\Domain\ValueObject\LocationState;

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
            new LocationId($request->id()),
            new LocationCode($request->code()),
            new LocationName($request->name()),
            new LocationMainContact($request->mainContact()),
            new LocationBarcode($request->barcode()),
            new LocationState($request->state()),
            new LocationDirection($request->direction()),
            new LocationCompanyId($request->companyId()),
            new LocationItemState($request->itemState())
        );

        $this->repository->save($location);
    }

}
