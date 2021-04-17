<?php

declare(strict_types=1);

namespace Medine\ERP\Locations\Application\Search;

use Medine\ERP\Locations\Domain\Entity\Location;
use Medine\ERP\Locations\Domain\LocationRepository;
use Medine\ERP\Shared\Domain\Criteria;
use Medine\ERP\Shared\Domain\Criteria\Filters;
use Medine\ERP\Shared\Domain\Criteria\Order;
use function Lambdish\Phunctional\map;

final class LocationSearcher
{
    private $repository;

    public function __construct(LocationRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(LocationSearcherRequest $request): LocationsSearcherResponse
    {
        $criteria = new Criteria(
            Filters::fromValues($request->filters()),
            Order::fromValues($request->orderBy(), $request->order()),
            $request->offset(),
            $request->limit()
        );

        return new LocationsSearcherResponse(...map(
            $this->toResponse(),
            $this->repository->matching($criteria)
        ));
    }

    private function toResponse(): \Closure
    {
        return static function (Location $location) {
            return new LocationSearcherResponse(
                $location->id()->value(),
                $location->code()->value(),
                $location->name()->value(),
                $location->mainContact()->value(),
                $location->barcode()->value(),
                $location->address()->value(),
                $location->state()->value()
            );
        };
    }


}
