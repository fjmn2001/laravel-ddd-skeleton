<?php

declare(strict_types=1);

namespace Tests\Feature\Locations;

use App\Models\User;
use Faker\Factory;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Laravel\Passport\Passport;
use Medine\ERP\Shared\Domain\ValueObjects\Uuid;
use Tests\TestCase;

final class LocationPostControllerTest extends TestCase
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
            'code' => $this->faker->randomElement(['code1', 'code2']),
            'name' => $this->faker->randomElement(['location1', 'location2']),
            'mainContact' => $this->faker->name,
            'barcode' => $this->faker->randomElement(['barcode1', 'barcode2']),
            'address' => $this->faker->randomElement(['address1', 'address2']),
            'itemState' => $this->faker->randomElement(['available', 'not_available']),
            'state' => $this->faker->randomElement(['active', 'inactive']),
            'companyId' => Uuid::random()->value(),

        ]);

        $response->assertJson([]);
        $response->assertStatus(201);
    }
}
