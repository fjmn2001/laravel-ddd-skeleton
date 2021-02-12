<?php

declare(strict_types=1);


namespace Medine\ERP\Product\Domain\Contracts;


use Medine\ERP\Product\Domain\Entity\Product;

interface ProductRepository
{
    public function save(Product $product): void;
}
