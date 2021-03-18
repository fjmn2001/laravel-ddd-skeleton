<?php

declare(strict_types=1);

namespace Tests\Feature\Items;

use App\Models\User;
use Faker\Factory;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Laravel\Passport\Passport;
use Ramsey\Uuid\Uuid;
use Tests\TestCase;

final class ItemsBreadcrumbsPostControllerTest extends TestCase
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
    public function it_should_get_items_breadcrumbs()
    {
        Passport::actingAs(
            User::factory()->create()
        );

        $response = $this->postJson('/api/items/breadcrumbs', [
            'name' => 'items',
            'params' => []
        ]);

        $response->assertStatus(200);
    }
}
