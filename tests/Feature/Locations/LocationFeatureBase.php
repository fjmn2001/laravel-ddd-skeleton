<?php

declare(strict_types=1);

namespace Tests\Feature\Locations;

use Faker\Factory;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\Feature\Shared\FeatureBase;

abstract class LocationFeatureBase extends FeatureBase
{
    use DatabaseTransactions;

    protected $faker;

    protected function setUp(): void
    {
        $this->faker = Factory::create();
        parent::setUp();
    }

    protected function buildLocation(string $id, $code, $name, string $mainContact, $barcode, $address, $itemState, $state, string $companyId): \Illuminate\Testing\TestResponse
    {
        return $this->postJson('/api/locations', [
            'id' => $id,
            'code' => $code,
            'name' => $name,
            'mainContact' => $mainContact,
            'barcode' => $barcode,
            'address' => $address,
            'itemState' => $itemState,
            'state' => $state,
            'companyId' => $companyId,

        ]);
    }
}
