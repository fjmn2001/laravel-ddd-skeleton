<?php

declare(strict_types=1);

namespace Tests\Unit\ERP\Product\Application\Search;

use Medine\ERP\Product\Application\Response\ProductCountResponse;
use Medine\ERP\Product\Application\Search\ProductCountSearcher;
use Medine\ERP\Product\Domain\Contracts\ProductRepository;
use PHPUnit\Framework\TestCase;

final class ProductCountSearcherTest extends TestCase
{
    /**
     * @test
     */
    public function it_should_get_the_existing_products_count()
    {
        $repository = $this->createMock(ProductRepository::class);
        $searcher = new ProductCountSearcher($repository);

        $this->shouldSearch($repository);

        $this->assertInstanceOf(
            ProductCountResponse::class,
            ($searcher)(ProductCountSearcherRequestMother::random())
        );
    }

    private function shouldSearch(\PHPUnit\Framework\MockObject\MockObject $repository): void
    {
        $repository->method('count')
            ->willReturn(0);
    }
}
