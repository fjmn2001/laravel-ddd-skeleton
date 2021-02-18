<?php

declare(strict_types=1);

namespace Medine\ERP\Product\Application\Find;

use Illuminate\Http\JsonResponse;
use Medine\ERP\Product\Domain\Contracts\ProductRepository;
use Medine\ERP\Product\Domain\ValueObjects\ProductId;

final class ProductFinder
{
    private $repository;
    private $finder;

    public function __construct(ProductRepository $repository)
    {
        $this->repository = $repository;
        $this->finder = new \Medine\ERP\Product\Domain\Service\ProductFinder($repository);
    }

    public function __invoke(FindProductRequest $request): ProductResponse
    {
        $product = ($this->finder)(new ProductId($request->id()));

        return new ProductResponse(
            $product->id()->value(),
            $product->code()->value(),
            $product->name()->value(),
            $product->categoryId()->value(),
            $product->description()->value(),
            $product->typeId()->value(),
            $product->state()->value()
        );
    }
}
