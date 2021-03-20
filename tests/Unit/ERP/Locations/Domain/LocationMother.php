<?php

declare(strict_types=1);

namespace Tests\Unit\ERP\Locations\Domain;

use Faker\Factory;
use Medine\ERP\Locations\Domain\Entity\Location;

final class LocationMother
{
    public static function random()
    {
        $faker = Factory::create();
        $id = $faker->uuid;
        $code = $faker->randomElement(['code1', 'code2']);
        $name = $faker->randomElement(['location1', 'location2']);
        $mainContact = $faker->name;
        $barcode = $faker->randomElement(['barcode1', 'barcode2']);
        $address = $faker->randomElement(['address1', 'address2']);
        $itemState = $faker->randomElement(['available', 'not_available']);
        $state = $faker->randomElement(['active', 'inactive']);
        $companyId = $faker->uuid;
        $createdBy = 1;

        return Location::create(
            $id,
            $code,
            $name,
            $mainContact,
            $barcode,
            $address,
            $itemState,
            $state,
            $companyId,
            $createdBy
        );
    }
}
