<?php

declare(strict_types=1);

namespace Tests\Unit\ERP\Locations\Application\Search;

use Medine\ERP\Locations\Application\Search\LocationSearcher;
use Medine\ERP\Locations\Domain\LocationRepository;
use PHPUnit\Framework\TestCase;

final class LocationSearcherTest extends TestCase
{
    /**
     * @test
     */
    public function it_should_search_locations(): void
    {
        $repository = $this->createMock(LocationRepository::class);
        $searcher = new LocationSearcher($repository);

        $repository->method('matching')
            ->willReturn([]);

        ($searcher)(LocationSearcherRequestMother::random());
        self::assertTrue(true);
    }
}
