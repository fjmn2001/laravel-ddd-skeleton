<?php

declare(strict_types=1);

namespace Tests\Unit\ERP\Locations\Application\Find;

use PHPUnit\Framework\TestCase;
use Tests\Unit\ERP\Locations\Domain\LocationMother;

final class LocationFinderTest extends TestCase
{

    /**
     * @test
     */
    public function it_should_find_an_existing_location(): void
    {
        $location = LocationMother::random();
        dd($location);
    }
}
