<?php

declare(strict_types=1);

namespace Tests\Feature\Items;

use App\Models\User;
use Faker\Factory;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Laravel\Passport\Passport;
use Ramsey\Uuid\Uuid;
use Tests\Feature\Shared\FeatureBase;

final class ItemOptionsGetControllerTest extends FeatureBase
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
    public function it_should_get_all_options_for_an_existing_item()
    {
        Passport::actingAs(
            User::factory()->create()
        );

        $companyId = Uuid::uuid4();
        $this->buildCompany($companyId, $this->faker);

        $itemId = Uuid::uuid4();
        $itemCode = $this->faker->randomElement(['code01', 'code02']);
        $itemName = $this->faker->randomElement(['item01', 'item02']);
        $itemReference = $this->faker->text(50);
        $itemType = $this->faker->randomElement(['inventoried', 'inventoried_serial', 'not_inventoried', 'service']);
        $itemCategoryId = Uuid::uuid4();
        $itemState = 'active';
        $this->postJson('/api/items', [
            'id' => $itemId,
            'code' => $itemCode,
            'name' => $itemName,
            'reference' => $itemReference,
            'type' => $itemType,
            'categoryId' => $itemCategoryId,
            'state' => $itemState,
            'companyId' => $companyId,
        ]);

        $response = $this->getJson('/api/items/options/' . $itemId);


        $response->assertStatus(200);
    }
}
