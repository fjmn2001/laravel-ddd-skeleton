<?php

declare(strict_types=1);

namespace Tests\Unit\ERP\Locations\Application\Search;

use Medine\ERP\Locations\Application\Search\LocationCountSearcher;
use Medine\ERP\Locations\Domain\LocationRepository;
use PHPUnit\Framework\TestCase;

final class LocationCountSearcherTest extends TestCase
{
    /**
     * @test
     */
    public function it_should_get_the_existing_locations_count(): void
    {
        $repository = $this->createMock(LocationRepository::class);
        $searcher = new LocationCountSearcher($repository);
        $response = ($searcher)(LocationCountSearcherRequestMother::random());

        $repository->method('count')->willReturn(0);

        self::assertEquals(0, $response->count());
    }
}
