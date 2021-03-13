<?php

declare(strict_types=1);

namespace Medine\ERP\Product\Application\Search;

use Medine\ERP\Product\Application\Response\ProductCountResponse;
use Medine\ERP\Product\Domain\Contracts\ProductRepository;
use Medine\ERP\Shared\Domain\Criteria;
use Medine\ERP\Shared\Domain\Criteria\Filters;
use Medine\ERP\Shared\Domain\Criteria\Order;

final class ProductCountSearcher
{
    private $repository;

    public function __construct(ProductRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(ProductCountSearcherRequest $request)
    {
        $criteria = new Criteria(
            Filters::fromValues($request->filters()),
            Order::fromValues($request->orderBy(), $request->order()),
            $request->offset(),
            $request->limit()
        );

        return new ProductCountResponse(
            $this->repository->count($criteria)
        );
    }
}
