<?php

declare(strict_types=1);

namespace Tests\Feature\Item;

use App\Models\User;
use Faker\Factory;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Laravel\Passport\Passport;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;
use Tests\TestCase;

final class ItemsPutControllerTest extends TestCase
{
    use DatabaseTransactions;

    protected $faker;

    protected function setUp(): void
    {
        $this->faker = Factory::create();

        parent::setUp();
    }

    /**
     * @test
     */
    public function it_should_update_an_existing_item()
    {
        Passport::actingAs(
            User::factory()->create()
        );

        $companyId = Uuid::uuid4();
        $categoryId = Uuid::uuid4();
        $itemId = Uuid::uuid4();
        $this->buildItem($categoryId, $companyId, $itemId);

        $response = $this->putJson('/api/item/' . $itemId, [
            'code' => $this->faker->randomElement(['code01', 'code02']),
            'name' => $this->faker->randomElement(['item01', 'item02']),
            'reference' => $this->faker->randomElement(['reference01', 'reference02']),
            'type' => $this->faker->randomElement(['inventoried', 'inventoried_serial', 'not_inventoried', 'service']),
            'categoryId' => Uuid::uuid4(),
            'state' => $this->faker->randomElement(['active', 'inactive'])
        ]);

        $response->assertJson([]);
        $response->assertStatus(200);
    }

    private function buildItem(UuidInterface $categoryId, UuidInterface $companyId, UuidInterface $itemId): void
    {
        $response = $this->postJson('/api/item', [
            'id' => $itemId,
            'code' => $this->faker->randomElement(['code01', 'code02']),
            'name' => $this->faker->randomElement(['item01', 'item02']),
            'reference' => $this->faker->text(50),
            'type' => $this->faker->randomElement(['inventoried', 'inventoried_serial', 'not_inventoried', 'service']),
            'categoryId' => $categoryId,
            'state' => 'active',
            'companyId' => $companyId,
        ]);
    }
}
