<?php

declare(strict_types=1);

namespace Tests\Feature\ClientCategories;

use App\Models\User;
use Faker\Factory;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Laravel\Passport\Passport;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;
use Tests\Feature\Shared\FeatureBase;

final class ClientCategoryStatePutControlletTest extends FeatureBase
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
    public function it_should_inactivate_an_existing_client_category()
    {

        Passport::actingAs(
            User::factory()->create()
        );

        $companyId = Uuid::uuid4();
        $clientCategoryId = Uuid::uuid4();

        $this->buildClientCategory($clientCategoryId, $companyId);

        $response = $this->putJson("/api/client_category/state/{$clientCategoryId}", [
            'state' => 'inactive'
        ]);
        $response->assertJson([]);
        $response->assertStatus(200);
    }

    private function buildClientCategory(UuidInterface $clientCategoryId, UuidInterface $companyId): void
    {
        $this->postJson('/api/client_category', [
            'id' => $clientCategoryId,
            'companyId' => $companyId,
            'name' => $this->faker->name,
            'description' => $this->faker->text(20),
            'state' => 'active',
        ]);
    }
}
