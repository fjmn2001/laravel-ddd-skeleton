<?php

declare(strict_types=1);

namespace Tests\Feature\Locations;

use App\Models\User;
use Laravel\Passport\Passport;
use Ramsey\Uuid\Uuid;

final class LocationOptionsGetControllerTest extends LocationFeatureBase
{
    /**
     * @test
     */
    public function it_should_get_location_options()
    {
        Passport::actingAs(
            User::factory()->create()
        );

        $companyId = Uuid::uuid4();
        $this->buildCompany($companyId, $this->faker);

        $id = \Medine\ERP\Shared\Domain\ValueObjects\Uuid::random()->value();
        $code = $this->faker->randomElement(['code1', 'code2']);
        $name = $this->faker->randomElement(['location1', 'location2']);
        $mainContact = $this->faker->name;
        $barcode = $this->faker->randomElement(['barcode1', 'barcode2']);
        $address = $this->faker->randomElement(['address1', 'address2']);
        $itemState = $this->faker->randomElement(['available', 'not_available']);
        $state = $this->faker->randomElement(['active', 'inactive']);
        $this->buildLocation($id, $code, $name, $mainContact, $barcode, $address, $itemState, $state, $companyId->toString());


        $response = $this->getJson('/api/locations/options/' . $id);
        $response->assertStatus(200);
    }
}
