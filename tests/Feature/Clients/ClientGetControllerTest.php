<?php

declare(strict_types=1);

namespace Tests\Feature\Clients;

use App\Models\User;
use Faker\Factory;
use Laravel\Passport\Passport;
use Medine\ERP\Shared\Domain\ValueObjects\Uuid;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

final class ClientGetControllerTest extends TestCase
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
    public function it_should_get_an_client_existing()
    {
        Passport::actingAs(
            User::factory()->create()
        );
        $clientId = Uuid::random()->value();
        $companyId = Uuid::random()->value();

        $client = [
            'id' => $clientId,
            'companyId' => $companyId,
            'name' => $this->faker->name,
            'lastname' => $this->faker->lastName,
            'dni' => '336-225-55',
            'dniType' => 'natural',
            'clientType' => 'contador',
            'clientCategory' => 'taller',
            'frequentClientNumber' => '111-222-333-5555',
            'state' => 'activo',
            'phones' => [
                [
                    'id' => Uuid::random()->value(),
                    'number' => '111-222-333-5555',
                    'numberType' => 'work',
                    'client_id' => $clientId
                ],
            ],
            'emails' => [
                [
                    'id' => Uuid::random()->value(),
                    'email' => $this->faker->email,
                    'emailType' => 'work',
                    'client_id' => $clientId
                ],
            ]
        ];

        $this->postJson('/api/client', $client);

        $response = $this->getJson('/api/client/' . $clientId);
        $response->assertJson($client);
        $response->assertStatus(200);
    }
}
