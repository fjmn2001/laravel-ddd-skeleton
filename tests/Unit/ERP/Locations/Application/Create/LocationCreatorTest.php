<?php

declare(strict_types=1);

namespace Tests\Unit\ERP\Locations\Application\Create;

use Faker\Factory;
use Medine\ERP\Locations\Application\Create\LocationCreator;
use Medine\ERP\Locations\Application\Create\LocationCreatorRequest;
use Medine\ERP\Product\Application\Create\CreateProductRequest;
use Medine\ERP\Product\Application\Create\ProductCreator;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;
use Tests\Unit\ERP\Locations\Infrastructure\InMemoryLocationRepository;
use Tests\Unit\ERP\Product\Infrastructure\InMemoryProductRepository;

final class LocationCreatorTest extends TestCase
{
    protected $creator;
    protected $faker;

    protected function setUp(): void
    {
        $this->creator = new LocationCreator(
            new InMemoryLocationRepository()
        );
        $this->faker = Factory::create();

        parent::setUp();
    }

    /**
     * @test
     */
    public function it_should_create_a_valid_location_and_return_null()
    {
        $response = ($this->creator)(new LocationCreatorRequest(
            Uuid::uuid4()->toString(),
            $this->faker->postcode,
            $this->faker->text(20),
            $this->faker->name,
            $this->faker->postcode,
            $this->faker->state,
            $this->faker->text(25),
            Uuid::uuid4()->toString(),
            $this->faker->text(15)
        ));

        $this->assertNull($response);
    }
}
