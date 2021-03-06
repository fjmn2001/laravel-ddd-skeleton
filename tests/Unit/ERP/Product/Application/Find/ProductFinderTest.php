<?php

declare(strict_types=1);

namespace Tests\Unit\ERP\Product\Application\Find;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Medine\ERP\Product\Application\Find\ProductFinder;
use Medine\ERP\Product\Domain\Contracts\ProductRepository;
use Medine\ERP\Product\Domain\Entity\Product;
use Tests\TestCase;
use Tests\Unit\ERP\Product\Domain\ProductMother;

final class ProductFinderTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * @test
     */
    public function it_should_find_an_existing_product()
    {
        $product = ProductMother::random();

        $repository = $this->createMock(ProductRepository::class);
        $this->shouldFind($repository, $product);

        $response = (new ProductFinder($repository))->__invoke(
            FindProductRequestMother::withId($product->id()->value())
        );

        $this->assertEquals($product->id()->value(), $response->id());
        $this->assertEquals($product->code()->value(), $response->code());
        $this->assertEquals($product->name()->value(), $response->name());
        $this->assertEquals($product->categoryId()->value(), $response->categoryId());
        $this->assertEquals($product->description()->value(), $response->description());
        $this->assertEquals($product->typeId()->value(), $response->typeId());
    }

    private function shouldFind(\PHPUnit\Framework\MockObject\MockObject $repository, Product $product): void
    {
        $repository->method('find')
            ->with($this->equalTo($product->id()))
            ->willReturn($product);
    }
}
