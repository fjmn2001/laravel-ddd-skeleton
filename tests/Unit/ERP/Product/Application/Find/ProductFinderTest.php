<?php

declare(strict_types=1);

namespace Tests\Unit\ERP\Product\Application\Find;

use Faker\Factory;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Medine\ERP\Product\Application\Create\CreateProductRequest;
use Medine\ERP\Product\Application\Create\ProductCreator;
use Medine\ERP\Product\Application\Find\FindProductRequest;
use Medine\ERP\Product\Application\Find\ProductFinder;
use Medine\ERP\Product\Domain\Entity\Product;
use Medine\ERP\Product\Domain\ValueObjects\ProductCategory;
use Medine\ERP\Product\Domain\ValueObjects\ProductCode;
use Medine\ERP\Product\Domain\ValueObjects\ProductDescription;
use Medine\ERP\Product\Domain\ValueObjects\ProductId;
use Medine\ERP\Product\Domain\ValueObjects\ProductName;
use Medine\ERP\Product\Domain\ValueObjects\ProductType;
use Medine\ERP\Product\Infrastructure\MySqlProductRepository;
use Ramsey\Uuid\Uuid;
use Tests\TestCase;

final class ProductFinderTest extends TestCase
{
    use DatabaseTransactions;

    protected $creator;
    protected $finder;
    protected $faker;

    protected function setUp(): void
    {
        $this->creator = new ProductCreator(
            new MySqlProductRepository()
        );
        $this->finder = new ProductFinder(
            new MySqlProductRepository()
        );

        $this->faker = Factory::create();

        parent::setUp();
    }

    /**
     * @test
     */
    public function it_should_find_an_existing_product()
    {
        $UUID = Uuid::uuid4()->toString();

        $product = Product::create(
            new ProductId($UUID),
            new ProductCode($this->faker->text(6)),
            new ProductName($this->faker->name),
            new ProductCategory(Uuid::uuid4()->toString()),
            new ProductDescription($this->faker->realText(255)),
            new ProductType(Uuid::uuid4()->toString())
        );

        ($this->creator)(new CreateProductRequest(
            $product->id()->value(),
            $product->code()->value(),
            $product->name()->value(),
            $product->categoryId()->value(),
            $product->description()->value(),
            $product->typeId()->value()
        ));

        $response = ($this->finder)(new FindProductRequest($UUID));

        $this->assertEquals($product->id()->value(), $response->id());
        $this->assertEquals($product->code()->value(), $response->code());
        $this->assertEquals($product->name()->value(), $response->name());
        $this->assertEquals($product->categoryId()->value(), $response->categoryId());
        $this->assertEquals($product->description()->value(), $response->description());
        $this->assertEquals($product->typeId()->value(), $response->typeId());
    }
}
