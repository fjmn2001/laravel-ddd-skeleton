<?php

declare(strict_types=1);

namespace Tests\Feature\Product;

use App\Models\User;
use Faker\Factory;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Laravel\Passport\Passport;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;
use Tests\TestCase;

final class ProductPutControllerTest extends TestCase
{
    use DatabaseTransactions;

    protected $faker;

    protected function setUp(): void
    {
        $this->faker = Factory::create();

        parent::setUp();
    }

    /**
     * @test
     */
    public function it_should_update_an_existing_product()
    {
        Passport::actingAs(
            User::factory()->create()
        );

        $companyId = Uuid::uuid4();
        $categoryId = Uuid::uuid4();
        $productId = Uuid::uuid4();
        $this->buildProduct($categoryId, $companyId, $productId);

        $response = $this->putJson('/api/product/' . $productId, [
            'code' => $this->faker->randomElement(['code01', 'code02']),
            'name' => $this->faker->randomElement(['item01', 'item02']),
            'reference' => $this->faker->randomElement(['reference01', 'reference02']),
            'type' => $this->faker->randomElement(['inventoried', 'inventoried_serial', 'not_inventoried', 'service']),
            'categoryId' => Uuid::uuid4(),
            'state' => $this->faker->randomElement(['active', 'inactive'])
        ]);

        $response->assertJson([]);
        $response->assertStatus(200);
    }

    private function buildProduct(UuidInterface $categoryId, UuidInterface $companyId, UuidInterface $productId): void
    {
        $response = $this->postJson('/api/product', [
            'id' => $productId,
            'code' => $this->faker->randomElement(['code01', 'code02']),
            'name' => $this->faker->randomElement(['item01', 'item02']),
            'reference' => $this->faker->text(50),
            'type' => $this->faker->randomElement(['inventoried', 'inventoried_serial', 'not_inventoried', 'service']),
            'categoryId' => $categoryId,
            'state' => 'active',
            'companyId' => $companyId,
        ]);
    }
}
