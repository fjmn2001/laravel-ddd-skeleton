<?php

declare(strict_types=1);

namespace Tests\Feature\Items;

use App\Models\User;
use Faker\Factory;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Laravel\Passport\Passport;
use Ramsey\Uuid\Uuid;
use Tests\Feature\Shared\FeatureBase;

final class ItemPostControllerTest extends FeatureBase
{
    use DatabaseTransactions;

    private $faker;

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
        $this->buildCompany($companyId, $this->faker);
        $this->buildCategory($categoryId, $companyId);

        $response = $this->postJson('/api/items', [
            'id' => Uuid::uuid4(),
            'code' => $this->faker->text(25),
            'name' => $this->faker->name,
            'reference' => $this->faker->text(50),
            'type' => $this->faker->randomElement(['inventoried', 'inventoried_serial', 'not_inventoried', 'service']),
            'category_id' => $categoryId,
            'state' => 'active',
            'companyId' => $companyId,
        ]);

        $response->assertJson([]);
        $response->assertStatus(201);
    }

    private function buildCategory($categoryId, $companyId)
    {
        $this->postJson('/api/item_categories', [
            'id' => $categoryId,
            'name' => $this->faker->name,
            'description' => $this->faker->text(50),
            'state' => 'active',
            'companyId' => $companyId,
        ]);
    }
}
