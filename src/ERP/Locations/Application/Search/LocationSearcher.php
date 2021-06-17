<?php

declare(strict_types=1);

namespace Medine\ERP\Locations\Application\Search;

use Closure;
use Medine\ERP\Locations\Domain\Entity\Location;
use Medine\ERP\Locations\Domain\LocationRepository;
use Medine\ERP\Locations\Domain\Service\LocationCounter;
use Medine\ERP\Shared\Domain\Criteria;
use Medine\ERP\Shared\Domain\Criteria\Filters;
use Medine\ERP\Shared\Domain\Criteria\Order;
use Medine\ERP\Shared\Domain\Jqgrid\JqgridUtils;
use function Lambdish\Phunctional\map;

final class LocationSearcher
{
    private $repository;
    private $counter;

    public function __construct(LocationRepository $repository)
    {
        $this->repository = $repository;
        $this->counter = new LocationCounter($repository);
    }

    public function __invoke(LocationSearcherRequest $request): LocationsSearcherResponse
    {
        $count = ($this->counter)($request->filters());
        [$totalPages, $page, $offset] = (new JqgridUtils)->pagination($count, $request->rows(), $request->page());
        $criteria = new Criteria(
            Filters::fromValues($request->filters()),
            Order::fromValues($request->sidx(), $request->sord()),
            $offset,
            $request->rows()
        );

        return new LocationsSearcherResponse($page, $totalPages, $count, ...map(
            $this->toResponse(),
            $this->repository->matching($criteria)
        ));
    }

    private function toResponse(): Closure
    {
        return static function (Location $location) {
            return [
                'id' => $location->id()->value(),
                'cell' => [
                    'code' => $location->code()->value(),
                    'name' => $location->name()->value(),
                    'mainContact' => $location->mainContact()->value(),
                    'barcode' => $location->barcode()->value(),
                    'address' => $location->address()->value(),
                    'state' => $location->state()->value()
                ]
            ];
        };
    }
}
