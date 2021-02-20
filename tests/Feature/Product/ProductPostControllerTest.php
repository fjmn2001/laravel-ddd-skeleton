<?php

declare(strict_types=1);

namespace Tests\Feature\Product;

use App\Models\User;
use Faker\Factory;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Laravel\Passport\Passport;
use Ramsey\Uuid\Uuid;
use Tests\TestCase;

final class ProductPostControllerTest extends TestCase
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
    public function it_should_create_a_new_product()
    {
        Passport::actingAs(
            User::factory()->create()
        );

        $response = $this->postJson('/api/product', [
            'id' => Uuid::uuid4()->toString(),
            'code' => $this->faker->randomElement(['qwertz']),
            'name' => $this->faker->name,
            'category_id' => Uuid::uuid4()->toString(),
            'description' => $this->faker->realText(255),
            'type_id' => Uuid::uuid4()->toString()
        ]);

        $response->assertJson([]);
        $response->assertStatus(201);
    }
}
