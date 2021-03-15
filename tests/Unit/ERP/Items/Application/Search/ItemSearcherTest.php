<?php

declare(strict_types=1);

namespace Tests\Unit\ERP\Items\Application\Search;

use Medine\ERP\Items\Application\Response\ItemsResponse;
use Medine\ERP\Items\Application\Search\ItemSearcher;
use Medine\ERP\Items\Domain\Contracts\ItemRepository;
use PHPUnit\Framework\TestCase;

final class ItemSearcherTest extends TestCase
{
    /**
     * @test
     */
    public function it_should_get_the_existing_items()
    {
        $repository = $this->createMock(ItemRepository::class);
        $searcher = new ItemSearcher($repository);

        $this->shouldSearch($repository);

        $this->assertInstanceOf(
            ItemsResponse::class,
            ($searcher)(ItemSearcherRequestMother::random())
        );
    }

    private function shouldSearch(\PHPUnit\Framework\MockObject\MockObject $repository): void
    {
        $repository->method('matching')
            ->willReturn([]);
    }
}
