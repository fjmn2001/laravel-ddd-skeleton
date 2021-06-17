<?php

declare(strict_types=1);

namespace Medine\ERP\Locations\Application\Search;

use Medine\ERP\Locations\Domain\LocationRepository;
use Medine\ERP\Shared\Domain\Criteria;
use Medine\ERP\Shared\Domain\Criteria\Filters;
use Medine\ERP\Shared\Domain\Criteria\Order;

final class LocationCountSearcher
{

    private $repository;

    public function __construct(LocationRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(LocationCountSearcherRequest $request): LocationCountSearcherResponse
    {
        $criteria = new Criteria(
            Filters::fromValues($request->filters()),
            Order::fromValues(null, null), null, null
        );

        return new LocationCountSearcherResponse(
            $this->repository->count($criteria)
        );
    }
}
