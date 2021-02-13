<?php

declare(strict_types=1);

namespace Medine\ERP\Product\Infrastructure;

use Illuminate\Support\Facades\DB;
use Medine\ERP\Product\Domain\Contracts\ProductRepository;
use Medine\ERP\Product\Domain\Entity\Product;
use Medine\ERP\Product\Domain\ValueObjects\ProductCategory;
use Medine\ERP\Product\Domain\ValueObjects\ProductCode;
use Medine\ERP\Product\Domain\ValueObjects\ProductCreatedAt;
use Medine\ERP\Product\Domain\ValueObjects\ProductDescription;
use Medine\ERP\Product\Domain\ValueObjects\ProductId;
use Medine\ERP\Product\Domain\ValueObjects\ProductName;
use Medine\ERP\Product\Domain\ValueObjects\ProductState;
use Medine\ERP\Product\Domain\ValueObjects\ProductType;
use Medine\ERP\Product\Domain\ValueObjects\ProductUpdatedAt;

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
            'state' => $product->state()->value(),
            'created_at' => $product->createdAt()->value(),
            'updated_at' => $product->updatedAt()->value()
        ]);
    }

    public function find(ProductId $productId): ?Product
    {
        $row = DB::table('productos')->where('productos.id', $productId->value())->first();

        return !empty($row) ? Product::fromValues(
            new ProductId($row->id),
            new ProductCode($row->code),
            new ProductName($row->name),
            new ProductCategory($row->category_id),
            new ProductDescription($row->description),
            new ProductType($row->type_id),
            new ProductState($row->state),
            new ProductCreatedAt($row->create_at),
            new ProductUpdatedAt($row->updated_at)
        ) : null;
    }

    public function update(Product $product): void
    {
        DB::table('products')->where('products.id', $product->id()->value())->take(1)->update([
            'code' => $product->code()->value(),
            'name' => $product->name()->value(),
            'category_id' => $product->categoryId()->value(),
            'description' => $product->description()->value(),
            'type_id' => $product->typeId()->value(),
            'state' => $product->state()->value(),
            'updated_at' => $product->updatedAt()->value(),
        ]);
    }
}
