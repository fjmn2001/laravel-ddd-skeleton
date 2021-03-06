<?php

declare(strict_types=1);

namespace Tests\Unit\ERP\Product\Application\Update;

use Faker\Factory;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Medine\ERP\Product\Application\Create\CreateProductRequest;
use Medine\ERP\Product\Application\Create\ProductCreator;
use Medine\ERP\Product\Application\Update\ProductUpdater;
use Medine\ERP\Product\Application\Update\UpdateProductRequest;
use Medine\ERP\Product\Domain\Contracts\ProductRepository;
use Medine\ERP\Product\Infrastructure\MySqlProductRepository;
use Ramsey\Uuid\Uuid;
use Tests\TestCase;
use Tests\Unit\ERP\Product\Application\Create\CreateProductRequestMother;
use Tests\Unit\ERP\Product\Domain\ProductMother;
use Tests\Unit\ERP\Product\Infrastructure\InMemoryProductRepository;

final class ProductUpdaterTest extends TestCase
{
    use DatabaseTransactions;

    protected $updater;

    protected function setUp(): void
    {
        $this->updater = new ProductUpdater(
            new InMemoryProductRepository()
        );

        parent::setUp();
    }

    /**
     * @test
     */
    public function it_should_update_an_existing_product_and_return_null()
    {
        $product = ProductMother::random();

        $repository = $this->createMock(ProductRepository::class);
        $this->shouldFind($repository, $product);
        $this->shouldUpdate($repository, $product);

        $response = (new ProductUpdater($repository))->__invoke(UpdateProductRequestMother::withId(
            $product->id()->value()
        ));

        $this->assertNull($response);
    }

    private function shouldFind(\PHPUnit\Framework\MockObject\MockObject $repository, \Medine\ERP\Product\Domain\Entity\Product $product): void
    {
        $repository->method('find')
            ->with($this->equalTo($product->id()))
            ->willReturn($product);
    }

    private function shouldUpdate(\PHPUnit\Framework\MockObject\MockObject $repository, \Medine\ERP\Product\Domain\Entity\Product $product): void
    {
        $repository->method('update')
            ->with($this->equalTo($product));
    }
}
