<?php

declare(strict_types=1);

namespace Tests\Feature\Auth;

use App\Models\User;
use Faker\Factory;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Laravel\Passport\Passport;
use Tests\TestCase;

final class AuthControllerTest extends TestCase
{
    use DatabaseTransactions;

    private $faker;

    protected function setUp(): void
    {
        $this->faker = Factory::create();;
        parent::setUp();
    }

    /**
     * @test
     */
    public function it_should_create_a_new_user()
    {
        Passport::actingAs(
            User::factory()->create()
        );

        $response = $this->postJson('/api/users', [
            'name' => $this->faker->name(),
            'email' => $this->faker->email,
            'password' => $this->faker->password
        ]);

        $response->assertJson([]);
        $response->assertStatus(201);
    }
}
