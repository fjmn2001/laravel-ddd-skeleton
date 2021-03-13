<?php

declare(strict_types=1);

namespace Medine\ERP\Product\Application\Search;

use Medine\ERP\Product\Application\Response\ProductResponse;
use Medine\ERP\Product\Application\Response\ProductsResponse;
use Medine\ERP\Product\Domain\Contracts\ProductRepository;
use Medine\ERP\Product\Domain\Entity\Product;
use Medine\ERP\Shared\Domain\Criteria;
use Medine\ERP\Shared\Domain\Criteria\Filters;
use Medine\ERP\Shared\Domain\Criteria\Order;
use function Lambdish\Phunctional\map;

final class ProductSearcher
{
    private $repository;

    public function __construct(ProductRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(ProductSearcherRequest $request)
    {
        $criteria = new Criteria(
            Filters::fromValues($request->filters()),
            Order::fromValues($request->orderBy(), $request->order()),
            $request->offset(),
            $request->limit()
        );

        return new ProductsResponse(...map(
            $this->toResponse(),
            $this->repository->matching($criteria)
        ));
    }

    private function toResponse(): callable
    {
        return function (Product $product) {
            return new ProductResponse(
                $product->id()->value(),
                $product->code()->value(),
                $product->name()->value(),
                $product->reference(),
                $product->type()->value(),
                $product->categoryId()->value(),
                $product->state()->value(),
                $product->averageCost(),
                $product->companyId()
            );
        };
    }
}
