<?php

declare(strict_types=1);

namespace Medine\ERP\Items\Application\Search;

use Medine\ERP\Items\Application\Response\ItemCountResponse;
use Medine\ERP\Items\Domain\Contracts\ItemRepository;
use Medine\ERP\Shared\Domain\Criteria;
use Medine\ERP\Shared\Domain\Criteria\Filters;
use Medine\ERP\Shared\Domain\Criteria\Order;

final class ItemCountSearcher
{
    private $repository;

    public function __construct(ItemRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(ItemCountSearcherRequest $request)
    {
        $criteria = new Criteria(
            Filters::fromValues($request->filters()),
            Order::fromValues($request->orderBy(), $request->order()),
            $request->offset(),
            $request->limit()
        );

        return new ItemCountResponse(
            $this->repository->count($criteria)
        );
    }
}
