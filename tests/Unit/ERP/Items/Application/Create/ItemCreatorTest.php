<?php

declare(strict_types=1);

namespace Tests\Unit\ERP\Items\Application\Create;

use Faker\Factory;
use Medine\ERP\Items\Application\Create\ItemCreator;
use Medine\ERP\Items\Application\Create\ItemCreatorRequest;
use Medine\ERP\Items\Infrastructure\Persistence\MySqlItemRepository;
use Mockery\MockInterface;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;
use Tests\Unit\ERP\Items\Infrastructure\Persistence\InMemoryItemRepository;

final class ItemCreatorTest extends TestCase
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
    public function it_should_create_a_new_item_and_return_null()
    {
        $categoryId = $this->faker->uuid;
        $companyId = $this->faker->uuid;
        $createdBy = $this->faker->numberBetween(1, 10);
        $creator = new ItemCreator(new InMemoryItemRepository);
        $response = ($creator)(new ItemCreatorRequest(
            $this->faker->uuid,
            $this->faker->text(25),
            $this->faker->name,
            $this->faker->text(50),
            $this->faker->randomElement(['inventoried', 'inventoried_serial', 'not_inventoried', 'service']),
            $categoryId,
            'active',
            $companyId,
            $createdBy
        ));

        $this->assertNull($response);
    }
}
