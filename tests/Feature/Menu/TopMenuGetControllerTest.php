<?php

declare(strict_types=1);

namespace Tests\Feature\Menu;

use App\Models\User;
use Laravel\Passport\Passport;
use Ramsey\Uuid\Uuid;
use Tests\TestCase;

final class TopMenuGetControllerTest extends TestCase
{
    /**
     * @test
     */
    public function it_should_get_top_menu()
    {
        Passport::actingAs(
            User::factory()->create()
        );

        $response = $this->json('GET', '/api/menu/top_menu');

        $response->assertJson([
            ['name' => 'inventory', 'title' => 'Inventory'],
            ['name' => 'companies', 'title' => 'Companies']
        ]);
        $response->assertStatus(200);
    }
}
