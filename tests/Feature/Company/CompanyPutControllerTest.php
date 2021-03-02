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

final class CompanyPutControllerTest extends TestCase
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
    public function it_should_update_an_existing_company()
    {
        Passport::actingAs(
            User::factory()->create()
        );

        $ROL_ID = Uuid::uuid4()->toString();

        $this->postJson('/api/company', [
            'id' => $ROL_ID,
            'name' => $this->faker->company,
            'address' => $this->faker->address,
            'state' => 'active',
            'logo' => "coca-cola.jpg",
        ]);

        $response = $this->putJson('/api/company/' . $ROL_ID, [
            'name' => $this->faker->company,
            'address' => $this->faker->address,
            'state' => 'active',
            'logo' => "coca-cola.jpg",
        ]);

        $response->assertJson([]);
        $response->assertStatus(200);
    }
}













