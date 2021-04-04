<?php

declare(strict_types=1);

namespace Tests\Feature\ClientCategories;

use App\Models\User;
use Faker\Factory;
use Laravel\Passport\Passport;
use Medine\ERP\Shared\Domain\ValueObjects\Uuid;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

final class ClientCategoryPostControllerTest extends TestCase
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
    public function it_should_create_a_new_client_category()
    {

        Passport::actingAs(
            User::factory()->create()
        );

        $clientCategoryId = Uuid::random()->value();
        $companyId = Uuid::random()->value();

        $response = $this->postJson('/api/client_category', [
            'id' => $clientCategoryId,
            'companyId' => $companyId,
            'name' => $this->faker->name,
            'description' => $this->faker->text(20),
            'state' => 'active',
        ]);

        $response->assertJson([]);
        $response->assertStatus(201);
    }
}
