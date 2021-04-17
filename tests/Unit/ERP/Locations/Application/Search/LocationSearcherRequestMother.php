<?php

declare(strict_types=1);

namespace Tests\Unit\ERP\Locations\Application\Search;

use Faker\Factory;
use Medine\ERP\Locations\Application\Search\LocationSearcherRequest;

final class LocationSearcherRequestMother
{
    public static function random(): LocationSearcherRequest
    {
        $faker = Factory::create();
        $filters = [['field' => 'companyId', 'value' => $faker->uuid]];
        $orderBy = null;
        $order = null;
        $offset = null;
        $limit = null;

        return self::create($filters, $orderBy, $order, $offset, $limit);
    }

    public static function create(array $filters, $orderBy, $order, $offset, $limit): LocationSearcherRequest
    {
        return new LocationSearcherRequest($filters, $orderBy, $order, $offset, $limit);
    }
}
