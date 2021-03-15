<?php

declare(strict_types=1);

namespace Tests\Unit\ERP\Items\Application\Search;

use Medine\ERP\Items\Application\Response\ItemCountResponse;
use Medine\ERP\Items\Application\Search\ItemCountSearcher;
use Medine\ERP\Items\Domain\Contracts\ItemRepository;
use PHPUnit\Framework\TestCase;

final class ItemCountSearcherTest extends TestCase
{
    /**
     * @test
     */
    public function it_should_get_the_existing_items_count()
    {
        $repository = $this->createMock(ItemRepository::class);
        $searcher = new ItemCountSearcher($repository);

        $this->shouldSearch($repository);

        $this->assertInstanceOf(
            ItemCountResponse::class,
            ($searcher)(ItemCountSearcherRequestMother::random())
        );
    }

    private function shouldSearch(\PHPUnit\Framework\MockObject\MockObject $repository): void
    {
        $repository->method('count')
            ->willReturn(0);
    }
}
