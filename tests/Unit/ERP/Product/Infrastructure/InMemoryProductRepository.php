<?php

declare(strict_types=1);

namespace Tests\Unit\ERP\Product\Infrastructure;

use Medine\ERP\Product\Domain\Contracts\ProductRepository;
use Medine\ERP\Product\Domain\Entity\Product;

final class InMemoryProductRepository implements ProductRepository
{

    public function save(Product $product): void
    {
        // TODO: Implement create() method.
    }
}
