<?php

declare(strict_types=1);

namespace Tests\Unit\ERP\Locations\Application\Find;

use Medine\ERP\Locations\Application\Find\LocationFinder;
use Medine\ERP\Locations\Domain\LocationRepository;
use PHPUnit\Framework\TestCase;
use Tests\Unit\ERP\Locations\Domain\LocationMother;

final class LocationFinderTest extends TestCase
{

    /**
     * @test
     * @throws \Medine\ERP\Locations\Application\Find\LocationNotExists
     */
    public function it_should_find_an_existing_location(): void
    {
        $location = LocationMother::random();
        $repository = $this->createMock(LocationRepository::class);

        $repository->method('find')
            ->with(self::equalTo($location->id()))
            ->willReturn($location);

        $finder = new LocationFinder($repository);
        $response = ($finder)(LocationFinderRequestMother::withId($location->id()->value()));

        self::assertEquals($response->id(), $location->id()->value());
    }
}
