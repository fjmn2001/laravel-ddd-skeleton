<?php

declare(strict_types=1);

namespace Medine\ERP\ClientTypes\Application\Search;

use Medine\ERP\ClientTypes\Domain\Contracts\ClientTypeRepository;
use Medine\ERP\Shared\Domain\Criteria;
use Medine\ERP\Shared\Domain\Criteria\Filters;
use Medine\ERP\Shared\Domain\Criteria\Order;

final class ClientTypeSearcher
{

    private $repository;

    public function __construct(
        ClientTypeRepository $repository
    )
    {
        $this->repository = $repository;
    }

    public function __invoke(ClientTypeSearcherRequest $request)
    {
        $criteria = new Criteria(
            Filters::fromValues($request->filters()),
            Order::fromValues($request->orderBy(), $request->order()),
            $request->offset(),
            $request->limit()
        );

        $response = $this->repository->matching($criteria);

        dd($response);
    }
}
