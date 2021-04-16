<?php

declare(strict_types=1);

namespace Tests\Unit\ERP\Locations\Domain;

use Faker\Factory;
use Medine\ERP\Locations\Domain\Entity\Location;

final class LocationMother
{
    public static function random(): Location
    {
        $faker = Factory::create();
        $id = $faker->uuid;
        $code = $faker->randomElement(['locationCode1', 'locationCode2']);
        $name = $faker->randomElement(['locationName1', 'locationName2']);
        $mainContact = $faker->randomElement(['locationMainContact1', 'locationMainContact2']);
        $barcode = $faker->randomElement(['locationBarcode1', 'locationBarcode2']);
        $address = $faker->randomElement(['locationAddress1', 'locationAddress2']);
        $itemState = $faker->randomElement(['available', 'not_available']);
        $state = $faker->randomElement(['active', 'inactive']);
        $companyId = $faker->uuid;
        $createdBy = $faker->numberBetween(1);

        return self::create($id, $code, $name, $mainContact, $barcode, $address, $itemState, $state, $companyId, $createdBy);
    }

    public static function create(
        string $id,
        string $code,
        string $name,
        string $mainContact,
        string $barcode,
        string $address,
        string $itemState,
        string $state,
        string $companyId,
        int $createdBy
    ): Location
    {
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
