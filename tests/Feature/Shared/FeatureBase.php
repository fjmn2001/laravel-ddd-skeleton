<?php

declare(strict_types=1);

namespace Tests\Feature\Shared;

use Tests\TestCase;

abstract class FeatureBase extends TestCase
{
    protected function buildCompany(\Ramsey\Uuid\UuidInterface $companyId, $faker): void
    {
        $this->postJson('/api/company', [
            'id' => $companyId,
            'name' => $faker->company,
            'address' => $faker->address,
            'state' => 'active',
            'logo' => "coca-cola.jpg",
        ]);
    }
}
