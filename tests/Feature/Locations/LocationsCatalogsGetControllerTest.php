<?php

declare(strict_types=1);

namespace Tests\Feature\Locations;

use App\Models\User;
use Laravel\Passport\Passport;
use Ramsey\Uuid\Uuid;

final class LocationsCatalogsGetControllerTest extends LocationFeatureBase
{
    /**
     * @test
     */
    public function it_should_get_locations_catalogs()
    {
        Passport::actingAs(
            User::factory()->create()
        );

        $companyId = Uuid::uuid4();
        $this->buildCompany($companyId, $this->faker);

        $response = $this->getJson('/api/locations/catalogs');

        $response->assertStatus(200);
    }
}
