<?php

declare(strict_types=1);

namespace Tests\Feature\ClientTypes;

use App\Models\User;
use Faker\Factory;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Laravel\Passport\Passport;
use Medine\ERP\Shared\Domain\ValueObjects\Uuid;
use Tests\TestCase;

final class ClientTypesGetControllerTest extends TestCase
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
    public function if_should_get_the_existing_client_category()
    {
        Passport::actingAs(
            User::factory()->create()
        );

        $clientTypeId = Uuid::random()->value();
        $clientTypeName = $this->faker->name;
        $companyId = Uuid::random()->value();

        $response = $this->postJson('/api/_client_type', [
            'id' => $clientTypeId,
            'companyId' => $companyId,
            'name' => $clientTypeName,
            'description' => $this->faker->text(20),
            'state' => 'active',
        ]);

        $response->assertJson([]);
        $response->assertStatus(201);

        $response = $this->json('GET', '/api/_client_type', [
            "page" => 1,
            'filters' => [
                ['field' => 'name', 'value' => $clientTypeName]
            ]
        ]);

        $response->assertStatus(200);
    }
}
