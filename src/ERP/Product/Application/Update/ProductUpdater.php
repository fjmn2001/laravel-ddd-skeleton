<?php

declare(strict_types=1);

namespace Medine\ERP\Product\Application\Update;

use Medine\ERP\Product\Domain\Contracts\ProductRepository;
use Medine\ERP\Product\Domain\Service\ProductFinder;
use Medine\ERP\Product\Domain\ValueObjects\ProductCategory;
use Medine\ERP\Product\Domain\ValueObjects\ProductCode;
use Medine\ERP\Product\Domain\ValueObjects\ProductDescription;
use Medine\ERP\Product\Domain\ValueObjects\ProductId;
use Medine\ERP\Product\Domain\ValueObjects\ProductName;
use Medine\ERP\Product\Domain\ValueObjects\ProductState;
use Medine\ERP\Product\Domain\ValueObjects\ProductType;

final class ProductUpdater
{
    private $repository;
    private $finder;

    public function __construct(ProductRepository $repository)
    {
        $this->repository = $repository;
        $this->finder = new ProductFinder($repository);
    }

    public function __invoke(UpdateProductRequest $request)
    {
        $product = ($this->finder)(new ProductId(
            $request->id()
        ));

        $product->changeCode(new ProductCode($request->code()));
        $product->changeName(new ProductName($request->name()));
        $product->changeCategoryId(new ProductCategory($request->categoryId()));
        $product->changeDescription(new ProductDescription($request->description()));
        $product->changeTypeId(new ProductType($request->typeId()));
        $product->changeState(new ProductState($request->state()));

        $this->repository->update($product);
    }
}
