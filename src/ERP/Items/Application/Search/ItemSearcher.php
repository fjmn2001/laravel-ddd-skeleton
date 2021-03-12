<?php

declare(strict_types=1);

namespace Medine\ERP\Items\Application\Search;

use Medine\ERP\Items\Application\Response\ItemsResponse;
use Medine\ERP\Items\Application\Response\ItemResponse;
use Medine\ERP\Items\Domain\Entity\Item;
use Medine\ERP\Items\Domain\Entity\ItemRepository;
use Medine\ERP\Shared\Domain\Criteria;
use Medine\ERP\Shared\Domain\Criteria\Filters;
use Medine\ERP\Shared\Domain\Criteria\Order;
use function Lambdish\Phunctional\map;

final class ItemSearcher
{
    private $repository;

    public function __construct(ItemRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(ItemSearcherRequest $request)
    {
        $criteria = new Criteria(
            Filters::fromValues($request->filters()),
            Order::fromValues($request->orderBy(), $request->order()),
            $request->offset(),
            $request->limit()
        );
        return new ItemsResponse(...map(
            $this->toResponse(),
            $this->repository->matching($criteria)
        ));
    }

    private function toResponse(): callable
    {
        return function (Item $category) {
            return new ItemResponse(
                $category->id(),
                $category->name(),
                $category->description(),
                $category->state(),
                $category->companyId()
            );
        };
    }
}
