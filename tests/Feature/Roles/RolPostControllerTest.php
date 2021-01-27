<?php

declare(strict_types=1);

namespace Tests\Feature\Roles;

use App\Models\User;
use Faker\Factory;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Laravel\Passport\Passport;
use Ramsey\Uuid\Uuid;
use Tests\TestCase;

final class RolPostControllerTest extends TestCase
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
    public function it_should_create_a_new_superuser_rol()
    {
        Passport::actingAs(
            User::factory()->create()
        );
        $response = $this->postJson('/api/roles', [
            'id' => Uuid::uuid4()->toString(),
            'name' => $this->faker->name(),
            'description' => $this->faker->text(25),
            'superuser' => 'yes',
            'company_id' => Uuid::uuid4()->toString(),//TODO: Implement this line
        ]);

        $response->assertJson([]);
        $response->assertStatus(201);
    }
}
