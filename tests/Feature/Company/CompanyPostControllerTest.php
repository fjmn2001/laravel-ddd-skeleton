<?php

declare(strict_types=1);

namespace Tests\Feature\Company;

use App\Models\User;
use Faker\Factory;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Passport\Passport;
use Ramsey\Uuid\Uuid;
use Tests\TestCase;

final class CompanyPostControllerTest extends TestCase
{
    use RefreshDatabase;

    private $faker;

    protected function setUp(): void
    {
        $this->faker = Factory::create();
        parent::setUp();
    }

    /**
     * @test
     */
    public function it_should_create_a_new_company()
    {
        Passport::actingAs(
            User::factory()->create()
        );

        $response = $this->postJson('/api/company', [
            'id' => Uuid::uuid4(),
            'name' => $this->faker->company,
            'address' => $this->faker->address,
            'status' => 'activo',
            'logo' => "coca-cola.jpg",
        ]);

        $response->assertJson([]);
        $response->assertStatus(201);
    }
}













