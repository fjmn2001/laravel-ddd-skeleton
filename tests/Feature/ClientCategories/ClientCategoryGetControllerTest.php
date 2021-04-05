<?php

declare(strict_types=1);

namespace Tests\Feature\ClientCategories;

use App\Models\User;
use Faker\Factory;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\JsonResponse;
use Laravel\Passport\Passport;
use Medine\ERP\Shared\Domain\ValueObjects\Uuid;
use Tests\TestCase;

final class ClientCategoryGetControllerTest extends TestCase
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
    public function it_should_get_a_client_category_existing()
    {


        Passport::actingAs(
            User::factory()->create()
        );

        $clientCategoryId = Uuid::random()->value();
        $companyId = Uuid::random()->value();

        $clientCategory = [
            'id' => $clientCategoryId,
            'companyId' => $companyId,
            'name' => $this->faker->name,
            'description' => $this->faker->text(20),
            'state' => 'active',
        ];

        $this->postJson('/api/client_category', $clientCategory);

        $response = $this->getJson("/api/client_category/{$clientCategoryId}");
        $response->assertJson($clientCategory);
        $response->assertStatus(JsonResponse::HTTP_OK);
    }

}
