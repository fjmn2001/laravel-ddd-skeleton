<?php

declare(strict_types=1);

namespace Tests\Unit\ERP\Locations\Application\Create;

use Faker\Factory;
use Medine\ERP\Locations\Application\Create\LocationCreator;
use Medine\ERP\Locations\Domain\LocationRepository;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

final class LocationCreatorTest extends TestCase
{
    private $faker;

    protected function setUp(): void
    {
        $this->faker = Factory::create();
        parent::setUp();
    }

    /**
     * @test
     */
    public function it_should_create_a_valid_location_and_return_null()
    {
        $repository = $this->createMock(LocationRepository::class);
        $this->shouldCreate($repository);
        $creator = new LocationCreator($repository);
        $response = ($creator)(LocationCreatorRequestMother::random());

        $this->assertNull($response);
    }

    private function shouldCreate(MockObject $repository): void
    {
        $repository->method('save');
    }
}
