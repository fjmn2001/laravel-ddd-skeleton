<?php

declare(strict_types=1);

namespace Tests\Feature\Menu;

use App\Models\User;
use Laravel\Passport\Passport;
use Ramsey\Uuid\Uuid;
use Tests\TestCase;

final class LeftMenuGetControllerTest extends TestCase
{
    /**
     * @test
     */
    public function it_should_get_inventory_left_menu()
    {
        Passport::actingAs(
            User::factory()->create()
        );

        $response = $this->json('GET', '/api/menu/left_menu', [
            "name" => 'inventory'
        ]);

        $response->assertJson([
            ['name' => 'inventory_settings', 'title' => 'Setting', 'class' => 'fa-fw icon-settings']
        ]);
        $response->assertStatus(200);
    }
}
