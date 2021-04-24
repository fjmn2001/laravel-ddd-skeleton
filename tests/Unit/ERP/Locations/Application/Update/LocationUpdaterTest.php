<?php

declare(strict_types=1);

namespace Tests\Unit\ERP\Locations\Application\Update;

use Medine\ERP\Locations\Application\Update\LocationUpdater;
use Medine\ERP\Locations\Domain\Entity\Location;
use Medine\ERP\Locations\Domain\LocationRepository;
use Medine\ERP\Locations\Domain\Service\LocationNotExists;
use PHPUnit\Framework\TestCase;
use Tests\Unit\ERP\Locations\Domain\LocationMother;

final class LocationUpdaterTest extends TestCase
{
    /**
     * @test
     * @throws LocationNotExists
     */
    public function it_should_update_an_existing_location(): void
    {
        $repository = $this->createMock(LocationRepository::class);
        $updater = new LocationUpdater($repository);
        $location = LocationMother::random();

        $this->shouldFind($repository, $location);
        $this->shouldUpdate($repository, $location);

        ($updater)(LocationUpdaterRequestMother::withId(
            $location->id()->value()
        ));

        self::assertTrue(true);
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
