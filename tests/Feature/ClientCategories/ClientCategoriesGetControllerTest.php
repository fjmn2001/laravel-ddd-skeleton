<?php

declare(strict_types=1);

namespace Tests\Feature\ClientCategories;

use App\Models\User;
use Faker\Factory;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Laravel\Passport\Passport;
use Medine\ERP\Shared\Domain\ValueObjects\Uuid;
use Tests\TestCase;

final class ClientCategoriesGetControllerTest extends TestCase
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
    public function if_should_get_the_existing_client_category()
    {
        Passport::actingAs(
            User::factory()->create()
        );

        $clientCategoryId = Uuid::random()->value();
        $clientCategoryName = $this->faker->name;
        $companyId = Uuid::random()->value();

        $response = $this->postJson('/api/client_category', [
            'id' => $clientCategoryId,
            'companyId' => $companyId,
            'name' => $clientCategoryName,
            'description' => $this->faker->text(20),
            'state' => 'active',
        ]);

        $response->assertJson([]);
        $response->assertStatus(201);

        $response = $this->json('GET', '/api/client_category', [
            "page" => 1,
            'filters' => [
                ['field' => 'name', 'value' => $clientCategoryName]
            ]
        ]);

        $response->assertStatus(200);
    }
}
