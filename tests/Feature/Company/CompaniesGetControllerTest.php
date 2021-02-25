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

final class CompaniesGetControllerTest extends TestCase
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
    public function it_should_get_the_existing_companies()
    {
        Passport::actingAs(
            User::factory()->create()
        );

        $companyId = Uuid::uuid4();
        $companyName = $this->faker->company;
        $companyAddress = $this->faker->address;
        $response = $this->postJson('/api/company', [
            'id' => $companyId,
            'name' => $companyName,
            'address' => $companyAddress,
            'state' => 'active',
            'logo' => "coca-cola.jpg",
        ]);

        $response->assertJson([]);
        $response->assertStatus(201);

        $response = $this->json('GET', '/api/company', [
            "page" => 1,
            'filters' => [
                ['field' => 'name', 'value' => $companyName]
            ]
        ]);

        $response->assertStatus(200);
    }
}
