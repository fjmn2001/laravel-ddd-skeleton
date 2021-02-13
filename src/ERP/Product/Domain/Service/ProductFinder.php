<?php

declare(strict_types=1);

namespace Medine\ERP\Product\Domain\Service;

use Medine\ERP\Product\Domain\Contracts\ProductRepository;
use Medine\ERP\Product\Domain\Entity\Product;
use Medine\ERP\Product\Domain\ValueObjects\ProductId;

final class ProductFinder
{
    private $repository;

    public function __construct(ProductRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(ProductId $id): ?Product
    {
        $product = $this->repository->find($id);

        if (null == $product)
            throw new ProductNotExistsException($id);

        return $product;
    }
}
