<?php

declare(strict_types=1);

namespace Medine\ERP\ClientCategories\Application\Search;

use Medine\ERP\ClientCategories\Application\Response\ClientCategoriesResponse;
use Medine\ERP\ClientCategories\Application\Response\ClientCategoryResponse;
use Medine\ERP\ClientCategories\Domain\Contracts\ClientCategoryRepository;
use Medine\ERP\ClientCategories\Domain\Entity\ClientCategory;
use Medine\ERP\Shared\Domain\Criteria;
use Medine\ERP\Shared\Domain\Criteria\Filters;
use Medine\ERP\Shared\Domain\Criteria\Order;

use function Lambdish\Phunctional\map;

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

        return new ClientCategoriesResponse(...map(
            $this->toResponse(),
            $this->repository->matching($criteria)
        ));
    }

    private function toResponse(): callable
    {
        return function (ClientCategory $clientCategory) {
            return new ClientCategoryResponse(
                $clientCategory->id()->value(),
                $clientCategory->name()->value(),
                $clientCategory->description()->value(),
                $clientCategory->state()->value(),
            );
        };
    }
}
