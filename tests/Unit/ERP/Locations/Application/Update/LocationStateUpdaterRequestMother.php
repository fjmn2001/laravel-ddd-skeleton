<?php

declare(strict_types=1);

namespace Tests\Unit\ERP\Locations\Application\Update;

use Faker\Factory;
use Medine\ERP\Locations\Application\Update\LocationStateUpdaterRequest;

final class LocationStateUpdaterRequestMother
{
    public static function withId(string $id): LocationStateUpdaterRequest
    {
        $faker = Factory::create();
        $state = $faker->randomElement(['active', 'inactive']);

        return self::create($id, $state);
    }

    public static function create(string $id, string $state): LocationStateUpdaterRequest
    {
        return new LocationStateUpdaterRequest($id, $state);
    }
}
