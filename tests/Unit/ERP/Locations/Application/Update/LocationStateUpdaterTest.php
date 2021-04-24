<?php

declare(strict_types=1);

namespace Tests\Unit\ERP\Locations\Application\Update;

use Medine\ERP\Locations\Application\Update\LocationStateUpdater;
use Medine\ERP\Locations\Domain\Entity\Location;
use Medine\ERP\Locations\Domain\LocationRepository;
use Medine\ERP\Locations\Domain\Service\LocationNotExists;
use PHPUnit\Framework\TestCase;
use Tests\Unit\ERP\Locations\Domain\LocationMother;

final class LocationStateUpdaterTest extends TestCase
{
    /**
     * @test
     * @throws LocationNotExists
     */
    public function it_should_update_the_state_from_an_existing_location(): void
    {
        $repository = $this->createMock(LocationRepository::class);
        $updater = new LocationStateUpdater($repository);
        $location = LocationMother::random();

        $this->shouldFind($repository, $location);
        $this->shouldUpdate($repository, $location);

        $request = LocationStateUpdaterRequestMother::withId($location->id()->value());
        ($updater)($request);

        self::assertEquals($request->id(), $location->id()->value());
        self::assertEquals($request->state(), $location->state()->value());
    }

    private function shouldFind($repository, Location $location): void
    {
        $repository->method('find')
            ->with(self::equalTo($location->id()))
            ->willReturn($location);
    }

    private function shouldUpdate($repository, Location $location): void
    {
        $repository->method('update')
            ->with(self::equalTo($location));
    }
}
