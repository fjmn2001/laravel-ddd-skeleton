<?php

declare(strict_types=1);

namespace Tests\Unit\ERP\Locations\Application\Update;

use Faker\Factory;
use Medine\ERP\Locations\Application\Update\LocationUpdaterRequest;

final class LocationUpdaterRequestMother
{
    public static function random(): LocationUpdaterRequest
    {
        $faker = Factory::create();
        $id = $faker->uuid;
        $code = $faker->randomElement(['code1', 'code2']);
        $name = $faker->randomElement(['name1', 'name2']);
        $mainContact = $faker->randomElement(['mainContact1', 'mainContact2']);
        $barcode = $faker->randomElement(['barcode1', 'barcode2', '']);
        $address = $faker->randomElement(['address1', 'address2']);
        $itemState = $faker->randomElement(['available', 'not_available']);
        $state = $faker->randomElement(['active', 'inactive']);
        $updatedBy = $faker->numberBetween(1);

        return new LocationUpdaterRequest(
            $id,
            $code,
            $name,
            $mainContact,
            $barcode,
            $address,
            $itemState,
            $state,
            $updatedBy
        );
    }

    public static function withId(string $id): LocationUpdaterRequest
    {
        $faker = Factory::create();
        $code = $faker->randomElement(['code1', 'code2']);
        $name = $faker->randomElement(['name1', 'name2']);
        $mainContact = $faker->randomElement(['mainContact1', 'mainContact2']);
        $barcode = $faker->randomElement(['barcode1', 'barcode2', '']);
        $address = $faker->randomElement(['address1', 'address2']);
        $itemState = $faker->randomElement(['available', 'not_available']);
        $state = $faker->randomElement(['active', 'inactive']);
        $updatedBy = $faker->numberBetween(1);

        return new LocationUpdaterRequest(
            $id,
            $code,
            $name,
            $mainContact,
            $barcode,
            $address,
            $itemState,
            $state,
            $updatedBy
        );
    }
}
