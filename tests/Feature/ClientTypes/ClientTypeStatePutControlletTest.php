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

final class ClientTypeStatePutControlletTest extends FeatureBase
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
    public function it_should_inactivate_an_existing_client_type()
    {

        Passport::actingAs(
            User::factory()->create()
        );

        $companyId = Uuid::uuid4();
        $clientTypeId = Uuid::uuid4();

        $this->buildClientType($clientTypeId, $companyId);

        $response = $this->putJson("/api/client_type/state/{$clientTypeId}", [
            'state' => 'inactive'
        ]);
        $response->assertJson([]);
        $response->assertStatus(200);
    }

    private function buildClientType(UuidInterface $clientTypeId, UuidInterface $companyId): void
    {
        $this->postJson('/api/client_type', [
            'id' => $clientTypeId,
            'companyId' => $companyId,
            'name' => $this->faker->name,
            'description' => $this->faker->text(20),
            'state' => 'active',
        ]);
    }
}
