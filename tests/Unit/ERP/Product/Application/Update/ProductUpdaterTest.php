<?php

declare(strict_types=1);

namespace Tests\Unit\ERP\Product\Application\Update;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Medine\ERP\Product\Application\Update\ProductUpdater;
use Medine\ERP\Product\Domain\Contracts\ProductRepository;
use Tests\TestCase;
use Tests\Unit\ERP\Product\Domain\ProductMother;

final class ProductUpdaterTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * @test
     */
    public function it_should_update_an_existing_product_and_return_null()
    {
        $product = ProductMother::random();
        $repository = $this->createMock(ProductRepository::class);
        $updater = new ProductUpdater($repository);

        $this->shouldFind($repository, $product);
        $this->shouldUpdate($repository, $product);

        $response = ($updater)(UpdateProductRequestMother::withId(
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
