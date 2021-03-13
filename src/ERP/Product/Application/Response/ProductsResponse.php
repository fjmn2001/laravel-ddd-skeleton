<?php

declare(strict_types=1);

namespace Medine\ERP\Product\Application\Response;

final class ProductsResponse
{
    private $products;

    public function __construct(ProductResponse ...$products)
    {
        $this->products = $products;
    }

    public function products(): array
    {
        return $this->products;
    }
}
