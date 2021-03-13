<?php

declare(strict_types=1);

namespace Tests\Feature\Item;

use App\Models\User;
use Faker\Factory;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Laravel\Passport\Passport;
use Tests\TestCase;

final class ItemsCountGetControllerTest extends TestCase
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
    public function it_should_get_the_existing_item_count()
    {
        Passport::actingAs(
            User::factory()->create()
        );

        $response = $this->json('GET', '/api/item/count', [
            'filters' => [
                ['field' => 'companyId', 'value' => $this->faker->uuid]
            ]
        ]);

        $response->assertStatus(200);
    }
}
