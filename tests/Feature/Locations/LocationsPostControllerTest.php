<?php

declare(strict_types=1);

namespace Tests\Feature\Locations;

use App\Models\User;
use Faker\Factory;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Laravel\Passport\Passport;
//use Ramsey\Uuid\Uuid;
use Medine\ERP\Shared\Domain\ValueObjects\Uuid;
use Tests\TestCase;

final class LocationsPostControllerTest extends TestCase
{
    use DatabaseTransactions;

    protected $faker;

    protected function setUp(): void
    {
        $this->faker = Factory::create();
        parent::setUp();
    }

    /**
     * @test
     */
    public function it_should_create_a_new_location()
    {
        Passport::actingAs(
            User::factory()->create()
        );

        $response = $this->postJson('/api/location', [
            'id' => Uuid::random()->value(),
            'code' => $this->faker->postcode,
            'name' => 'bodega',
            'mainContact' => $this->faker->name,
            'barcode' => $this->faker->postcode,
            'state' => 'activo',
            'direction' => 'el paraiso',
            'companyId' => Uuid::random()->value(),
            'itemState' => 'disponible'
        ]);

        $response->assertJson([]);
        $response->assertStatus(201);
    }
}
