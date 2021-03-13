<?php

declare(strict_types=1);

namespace Tests\Unit\ERP\Product\Application\Search;

use Medine\ERP\Product\Application\Response\ProductsResponse;
use Medine\ERP\Product\Application\Search\ProductSearcher;
use Medine\ERP\Product\Domain\Contracts\ProductRepository;
use PHPUnit\Framework\TestCase;

final class ProductSearcherTest extends TestCase
{
    /**
     * @test
     */
    public function it_should_get_the_existing_products()
    {
        $repository = $this->createMock(ProductRepository::class);
        $searcher = new ProductSearcher($repository);

        $this->shouldSearch($repository);

        $this->assertInstanceOf(
            ProductsResponse::class,
            ($searcher)(ProductSearcherRequestMother::random())
        );
    }

    private function shouldSearch(\PHPUnit\Framework\MockObject\MockObject $repository): void
    {
        $repository->method('matching')
            ->willReturn([]);
    }
}
