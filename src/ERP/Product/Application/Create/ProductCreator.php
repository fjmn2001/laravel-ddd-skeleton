<?php

declare(strict_types=1);

namespace Medine\ERP\Product\Application\Create;

use Medine\ERP\Product\Domain\Contracts\ProductRepository;
use Medine\ERP\Product\Domain\Entity\Product;
use Medine\ERP\Product\Domain\ValueObjects\ProductCategory;
use Medine\ERP\Product\Domain\ValueObjects\ProductCode;
use Medine\ERP\Product\Domain\ValueObjects\ProductDescription;
use Medine\ERP\Product\Domain\ValueObjects\ProductId;
use Medine\ERP\Product\Domain\ValueObjects\ProductName;
use Medine\ERP\Product\Domain\ValueObjects\ProductType;

final class ProductCreator
{
    private $repository;

    public function __construct(ProductRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(CreateProductRequest $request)
    {
        $product = Product::create(
            new ProductId($request->id()),
            new ProductCode($request->code()),
            new ProductName($request->name()),
            new ProductCategory($request->categoryId()),
            new ProductDescription($request->description()),
            new ProductType($request->typeId())
        );

        $this->repository->save($product);
    }
}
