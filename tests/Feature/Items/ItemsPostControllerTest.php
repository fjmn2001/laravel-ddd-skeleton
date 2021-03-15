<?php

declare(strict_types=1);

namespace Tests\Feature\Items;

use App\Models\User;
use Faker\Factory;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Laravel\Passport\Passport;
use Ramsey\Uuid\Uuid;
use Tests\TestCase;

final class ItemsPostControllerTest extends TestCase
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
    public function it_should_create_a_new_item()
    {
        Passport::actingAs(
            User::factory()->create()
        );

        $companyId = Uuid::uuid4();
        $categoryId = Uuid::uuid4();
        $response = $this->postJson('/api/items', [
            'id' => Uuid::uuid4()->toString(),
            'code' => $this->faker->randomElement(['code01', 'code02']),
            'name' => $this->faker->randomElement(['item01', 'item02']),
            'reference' => $this->faker->text(50),
            'type' => $this->faker->randomElement(['inventoried', 'inventoried_serial', 'not_inventoried', 'service']),
            'categoryId' => $categoryId,
            'state' => 'active',
            'companyId' => $companyId,
        ]);

        $response->assertJson([]);
        $response->assertStatus(201);
    }
}
