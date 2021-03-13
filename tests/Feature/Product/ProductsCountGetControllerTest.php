<?php

declare(strict_types=1);

namespace Tests\Feature\Product;

use App\Models\User;
use Faker\Factory;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Laravel\Passport\Passport;
use Tests\TestCase;

final class ProductsCountGetControllerTest extends TestCase
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
    public function it_should_get_the_existing_product_count()
    {
        Passport::actingAs(
            User::factory()->create()
        );

        $response = $this->json('GET', '/api/products/count', [
            'filters' => [
                ['field' => 'companyId', 'value' => $this->faker->uuid]
            ]
        ]);

        $response->assertStatus(200);
    }
}
