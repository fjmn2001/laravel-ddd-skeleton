<?php

declare(strict_types=1);

namespace Tests\Unit\ERP\Product\Infrastructure;

use Medine\ERP\Product\Domain\Contracts\ProductRepository;
use Medine\ERP\Product\Domain\Entity\Product;
use Medine\ERP\Product\Domain\ValueObjects\ProductId;

final class InMemoryProductRepository implements ProductRepository
{

    public function save(Product $product): void
    {
        // TODO: Implement create() method.
    }

    public function find(ProductId $productId): ?Product
    {
        return null;
    }

    public function update(Product $product): void
    {
        // TODO: Implement update() method.
    }
}
