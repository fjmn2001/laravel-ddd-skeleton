<?php

declare(strict_types=1);

namespace Medine\ERP\Shared\Application\Search;

use Medine\ERP\Company\Application\Response\CompanyCatalogsResponse;
use Medine\ERP\Shared\Domain\CatalogRepository;
use Medine\ERP\Shared\Domain\Criteria;
use Medine\ERP\Shared\Domain\Criteria\Filters;
use Medine\ERP\Shared\Domain\Criteria\Order;

final class CatalogSearcher
{
    private $repository;

    public function __construct(CatalogRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(SearcherRequest $request, $response)
    {
        $criteria = new Criteria(
            Filters::fromValues($request->filters()),
            Order::fromValues($request->orderBy(), $request->order()),
            $request->offset(),
            $request->limit()
        );

        ($response)($this->repository->matching($criteria));

        return $response;
    }
}
