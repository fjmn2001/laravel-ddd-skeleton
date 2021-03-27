<?php

declare(strict_types=1);

namespace Tests\Feature\Clients;

use App\Models\User;
use Faker\Factory;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Laravel\Passport\Passport;
use Medine\ERP\Shared\Domain\ValueObjects\Uuid;
use Tests\TestCase;

final class ClientPutControllerTest extends TestCase
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
    public function it_should_update_an_existing_client()
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
            'phones' => [],
            'emails' => []
        ];
        $this->postJson('/api/client', $client);

        $client['name'] = 'kakashi hatake';
        $client['dniType'] = 'hokage';

        $response = $this->putJson('/api/client/' . $clientId, $client);
        $response->assertJson([]);
        $response->assertStatus(200);
    }
}
