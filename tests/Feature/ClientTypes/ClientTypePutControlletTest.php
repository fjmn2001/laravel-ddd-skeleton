<?php

declare(strict_types=1);

namespace Tests\Feature\ClientTypes;

use App\Models\User;
use Faker\Factory;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Laravel\Passport\Passport;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;
use Tests\Feature\Shared\FeatureBase;

final class ClientTypePutControlletTest extends FeatureBase
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
    public function it_should_update_a_client_type_existing()
    {

        Passport::actingAs(
            User::factory()->create()
        );

        $companyId = Uuid::uuid4();
        $clientType = Uuid::uuid4();

        $this->buildClientType($clientType, $companyId);

        $response = $this->putJson("/api/client_type/{$clientType}", [
            'companyId' => $companyId,
            'name' => $this->faker->name,
            'description' => $this->faker->text(20),
            'state' => $this->faker->randomElement(['active', 'inactive'])
        ]);
        $response->assertJson([]);
        $response->assertStatus(200);
    }

    private function buildClientType(UuidInterface $clientCategoryId, UuidInterface $companyId): void
    {
        $this->postJson('/api/client_type', [
            'id' => $clientCategoryId,
            'companyId' => $companyId,
            'name' => $this->faker->name,
            'description' => $this->faker->text(20),
            'state' => 'active',
        ]);
    }
}
