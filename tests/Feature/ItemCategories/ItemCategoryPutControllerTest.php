<?php

declare(strict_types=1);

namespace Tests\Feature\ItemCategories;

use App\Models\User;
use Faker\Factory;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Laravel\Passport\Passport;
use Ramsey\Uuid\Uuid;
use Tests\Feature\Shared\FeatureBase;

final class ItemCategoryPutControllerTest extends FeatureBase
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
    public function it_should_update_an_existing_item_category()
    {
        Passport::actingAs(
            User::factory()->create()
        );

        $companyId = Uuid::uuid4();
        $categoryId = Uuid::uuid4();
        $this->buildCompany($companyId, $this->faker);

        $this->buildItemCategory($categoryId, $companyId);

        $response = $this->putJson('/api/item_categories/' . $categoryId, [
            'name' => $this->faker->name,
            'description' => $this->faker->text(50),
            'state' => $this->faker->randomElement(['active', 'inactive'])
        ]);

        $response->assertJson([]);
        $response->assertStatus(200);
    }

    private function buildItemCategory(\Ramsey\Uuid\UuidInterface $categoryId, \Ramsey\Uuid\UuidInterface $companyId): void
    {
        $response = $this->postJson('/api/item_categories', [
            'id' => $categoryId,
            'name' => $this->faker->name,
            'description' => $this->faker->text(50),
            'state' => 'active',
            'companyId' => $companyId,
        ]);

        $response->assertJson([]);
        $response->assertStatus(201);
    }
}
