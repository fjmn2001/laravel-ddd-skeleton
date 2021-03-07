<?php

declare(strict_types=1);

namespace Tests\Feature\ItemCategories;

use App\Models\User;
use Faker\Factory;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Laravel\Passport\Passport;
use Ramsey\Uuid\Uuid;
use Tests\Feature\Shared\FeatureBase;

final class ItemCategoriesCountGetControllerTest extends FeatureBase
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
    public function it_should_get_the_existing_item_category_count()
    {
        Passport::actingAs(
            User::factory()->create()
        );

        $companyId = Uuid::uuid4();
        $this->buildCompany($companyId, $this->faker);

        $categoryId = Uuid::uuid4();
        $categoryName = $this->faker->name;
        $categoryDescription = $this->faker->text(50);
        $this->postJson('/api/item_categories', [
            'id' => $categoryId,
            'name' => $categoryName,
            'description' => $categoryDescription,
            'state' => 'active',
            'companyId' => $companyId,
        ]);

        $response = $this->json('GET', '/api/item_categories/count', [
            "page" => 1,
            'filters' => [
                ['field' => 'companyId', 'value' => $companyId]
            ]
        ]);

        $response->assertStatus(200);
    }
}
