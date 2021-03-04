<?php

declare(strict_types=1);

namespace Tests\Feature\ItemCategories;

use App\Models\User;
use Faker\Factory;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Laravel\Passport\Passport;
use Ramsey\Uuid\Uuid;
use Tests\TestCase;

final class ItemCategoryPostControllerTest extends TestCase
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
    public function it_should_create_a_new_item_category()
    {
        Passport::actingAs(
            User::factory()->create()
        );

        $companyId = Uuid::uuid4();
        $this->buildCompany($companyId);

        $response = $this->postJson('/api/item_categories', [
            'id' => Uuid::uuid4(),
            'name' => $this->faker->name,
            'description' => $this->faker->text(50),
            'state' => 'active',
            'companyId' => $companyId,
        ]);

        //dd($response->getContent());
        $response->assertJson([]);
        $response->assertStatus(201);
    }

    private function buildCompany(\Ramsey\Uuid\UuidInterface $companyId): void
    {
        $this->postJson('/api/company', [
            'id' => $companyId,
            'name' => $this->faker->company,
            'address' => $this->faker->address,
            'state' => 'active',
            'logo' => "coca-cola.jpg",
        ]);
    }
}
