<?php

declare(strict_types=1);

namespace Medine\ERP\Product\Infrastructure;

use Illuminate\Support\Facades\DB;
use Medine\ERP\ItemCategories\Infrastructure\Persistence\MySqlItemCategoryFilters;
use Medine\ERP\Product\Domain\Contracts\ProductRepository;
use Medine\ERP\Product\Domain\Entity\Product;
use Medine\ERP\Product\Domain\ValueObjects\ProductCategoryId;
use Medine\ERP\Product\Domain\ValueObjects\ProductCode;
use Medine\ERP\Product\Domain\ValueObjects\ProductCreatedAt;
use Medine\ERP\Product\Domain\ValueObjects\ProductId;
use Medine\ERP\Product\Domain\ValueObjects\ProductName;
use Medine\ERP\Product\Domain\ValueObjects\ProductState;
use Medine\ERP\Product\Domain\ValueObjects\ProductType;
use Medine\ERP\Product\Domain\ValueObjects\ProductUpdatedAt;
use Medine\ERP\Shared\Domain\Criteria;
use Medine\ERP\Shared\Infrastructure\MySqlRepository;

final class MySqlProductRepository extends MySqlRepository implements ProductRepository
{

    public function save(Product $product): void
    {
        DB::table('products')->insert([
            'id' => $product->id()->value(),
            'code' => $product->code()->value(),
            'name' => $product->name()->value(),
            'reference' => $product->reference(),
            'type' => $product->type()->value(),
            'category_id' => $product->categoryId()->value(),
            'state' => $product->state()->value(),
            'company_id' => $product->companyId(),
            'created_by' => $product->createdBy(),
            'updated_by' => $product->updatedBy(),
            'created_at' => $product->createdAt()->value(),
            'updated_at' => $product->updatedAt()->value()
        ]);
    }

    public function find(ProductId $productId): ?Product
    {
        $row = DB::table('products')->where('products.id', $productId->value())->first();

        return !empty($row) ? Product::fromValues(
            new ProductId($row->id),
            new ProductCode($row->code),
            new ProductName($row->name),
            $row->reference,
            new ProductType($row->type),
            new ProductCategoryId($row->category_id),
            new ProductState($row->state),
            $row->company_id,
            $row->created_by,
            $row->updated_by,
            new ProductCreatedAt($row->created_at),
            new ProductUpdatedAt($row->updated_at)
        ) : null;
    }

    public function update(Product $product): void
    {
        DB::table('products')->where('products.id', $product->id()->value())->take(1)->update([
            'code' => $product->code()->value(),
            'name' => $product->name()->value(),
            'reference' => $product->reference(),
            'type' => $product->type()->value(),
            'category_id' => $product->categoryId()->value(),
            'state' => $product->state()->value(),
            'updated_by' => $product->updatedBy(),
            'updated_at' => $product->updatedAt()->value(),
        ]);
    }

    public function count(\Medine\ERP\Shared\Domain\Criteria $criteria): int
    {
        $query = DB::table('products');
        $query = (new MySqlProductFilters($query))($criteria);

        return (int)$query->count();
    }

    public function matching(Criteria $criteria): array
    {
        $query = DB::table('item_categories');
        $query = (new MySqlItemCategoryFilters($query))($criteria);
        $query = $this->completeBuilder($criteria, $query);

        return $query->get()->map($this->buildProduct())->toArray();
    }

    private function buildProduct(): \Closure
    {
        return function ($row) {
            return Product::fromValues(
                new ProductId($row->id),
                new ProductCode($row->code),
                new ProductName($row->name),
                $row->reference,
                new ProductType($row->type),
                new ProductCategoryId($row->category_id),
                new ProductState($row->state),
                $row->company_id,
                $row->created_by,
                $row->updated_by,
                new ProductCreatedAt($row->created_at),
                new ProductUpdatedAt($row->updated_at)
            );
        };
    }
}
