<?php

declare(strict_types=1);

namespace Medine\ERP\Product\Infrastructure;

use Illuminate\Support\Facades\DB;
use Medine\ERP\Product\Domain\Contracts\ProductRepository;
use Medine\ERP\Product\Domain\Entity\Product;

final class MySqlProductRepository implements ProductRepository
{

    public function save(Product $product): void
    {
        DB::table('products')->insert([
            'id' => $product->id()->value(),
            'code' => $product->code()->value(),
            'name' => $product->name()->value(),
            'category_id' => $product->categoryId()->value(),
            'description' => $product->description()->value(),
            'type_id' => $product->typeId()->value(),
            'created_at' => $product->createdAt()->value(),
            'updated_at' => $product->updatedAt()->value()
        ]);
    }
}
