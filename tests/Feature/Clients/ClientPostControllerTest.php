<?php

declare(strict_types=1);

namespace Tests\Feature\Clients;

use App\Models\User;
use Faker\Factory;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Laravel\Passport\Passport;
use Medine\ERP\Shared\Domain\ValueObjects\Uuid;
use Tests\TestCase;

final class ClientPostControllerTest extends TestCase
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
    public function it_should_create_a_new_client()
    {
        Passport::actingAs(
            User::factory()->create()
        );

        $response = $this->postJson('/api/client', [
            'id' => Uuid::random()->value(),
            'name' => $this->faker->name,
            'lastname' => $this->faker->lastName,
            'dni' => '336-225-55',
            'dni_type' => 'natural',
            'client_type' => 'contador',
            'client_category' => 'taller',
            'frequent_client_number' => '111-222-333-5555',
            'state' => 'activo',
            'phones' => [
                [
                    'number' => '111-222-333-5555',
                    'number_type' => 'work',
                ],
            ],
            'emails' => [
                [
                    'email' => 'admin@gmail.com',
                    'number_type' => 'work',
                ],
            ]
        ]);

        $response->assertJson([]);
        $response->assertStatus(201);
    }
}
