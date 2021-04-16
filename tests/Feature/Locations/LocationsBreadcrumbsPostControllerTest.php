<?php

declare(strict_types=1);

namespace Tests\Feature\Locations;

use App\Models\User;
use Laravel\Passport\Passport;

final class LocationsBreadcrumbsPostControllerTest extends LocationFeatureBase
{
    /**
     * @test
     */
    public function it_should_get_locations_breadcrumbs()
    {
        Passport::actingAs(
            User::factory()->create()
        );

        $response = $this->postJson('/api/locations/breadcrumbs', [
            'name' => 'locations',
            'params' => []
        ]);

        $response->assertStatus(200);
    }
}
