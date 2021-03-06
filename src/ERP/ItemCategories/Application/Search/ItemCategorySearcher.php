<?php

declare(strict_types=1);

namespace Medine\ERP\ItemCategories\Application\Search;

use Medine\ERP\ItemCategories\Application\Response\ItemCategoriesResponse;
use Medine\ERP\ItemCategories\Application\Response\ItemCategoryResponse;
use Medine\ERP\ItemCategories\Domain\Entity\ItemCategory;
use Medine\ERP\ItemCategories\Domain\Entity\ItemCategoryRepository;
use Medine\ERP\Shared\Domain\Criteria;
use Medine\ERP\Shared\Domain\Criteria\Filters;
use Medine\ERP\Shared\Domain\Criteria\Order;
use function Lambdish\Phunctional\map;

final class ItemCategorySearcher
{
    private $repository;

    public function __construct(ItemCategoryRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(ItemCategorySearcherRequest $request)
    {
        $criteria = new Criteria(
            Filters::fromValues($request->filters()),
            Order::fromValues($request->orderBy(), $request->order()),
            $request->offset(),
            $request->limit()
        );
        return new ItemCategoriesResponse(...map(
            $this->toResponse(),
            $this->repository->matching($criteria)
        ));
    }

    private function toResponse(): callable
    {
        return function (ItemCategory $category) {
            return new ItemCategoryResponse(
                $category->id(),
                $category->name(),
                $category->description(),
                $category->state(),
                $category->companyId()
            );
        };
    }
}
