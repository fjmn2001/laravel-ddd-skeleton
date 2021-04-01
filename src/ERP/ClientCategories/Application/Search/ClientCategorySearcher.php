<?php

declare(strict_types=1);

namespace Medine\ERP\ClientCategories\Application\Search;

use Medine\ERP\ClientCategories\Domain\Contracts\ClientCategoryRepository;
use Medine\ERP\Shared\Domain\Criteria;
use Medine\ERP\Shared\Domain\Criteria\Filters;
use Medine\ERP\Shared\Domain\Criteria\Order;

final class ClientCategorySearcher
{

    private $repository;

    public function __construct(
        ClientCategoryRepository $repository
    )
    {
        $this->repository = $repository;
    }

    public function __invoke(ClientCategorySearcherRequest $request)
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
