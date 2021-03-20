<?php

declare(strict_types=1);

namespace Tests\Feature\Clients;

use App\Models\User;
use Faker\Factory;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Laravel\Passport\Passport;
use Medine\ERP\Shared\Domain\ValueObjects\Uuid;
use Tests\TestCase;

final class ClientsGetControllerTest extends TestCase
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
    public function it_should_get_the_existing_clients()
    {

        Passport::actingAs(
            User::factory()->create()
        );

        $clientId = Uuid::random()->value();
        $clientName = $this->faker->name;

        $response = $this->postJson('/api/client', [
            'id' => $clientId,
            'name' => $clientName,
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
                ],
            ],
            'emails' => [
                [
                    'id' => Uuid::random()->value(),
                    'email' => $this->faker->email,
                    'emailType' => 'work',
                ],
            ]
        ]);

        $response->assertJson([]);
        $response->assertStatus(201);


        $response = $this->json('GET', '/api/client', [
            "page" => 1,
            'filters' => [
                ['field' => 'name', 'value' => $clientName]
            ]
        ]);

        $response->assertStatus(200);
    }


}
