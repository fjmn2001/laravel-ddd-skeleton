<?php

declare(strict_types=1);

namespace Medine\ERP\Locations\Domain\Service;

use Medine\ERP\Locations\Domain\LocationRepository;
use Medine\ERP\Shared\Domain\Criteria;
use Medine\ERP\Shared\Domain\Criteria\Filters;
use Medine\ERP\Shared\Domain\Criteria\Order;

final class LocationCounter
{
    private $repository;

    public function __construct(LocationRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(array $filters): int
    {
        $criteria = new Criteria(
            Filters::fromValues($filters),
            Order::fromValues(null, null), null, null
        );
        return $this->repository->count($criteria);
    }
}
