<?php

declare(strict_types=1);

namespace Tests\Unit\ERP\Locations\Application\Create;

use Faker\Factory;
use Medine\ERP\Locations\Application\Create\LocationCreatorRequest;

final class LocationCreatorRequestMother
{
    public static function random(): LocationCreatorRequest
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
        int $createdBy): LocationCreatorRequest
    {
        return new LocationCreatorRequest(
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
