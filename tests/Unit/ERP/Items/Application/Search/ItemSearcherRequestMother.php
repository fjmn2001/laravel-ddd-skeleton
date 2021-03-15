<?php

declare(strict_types=1);

namespace Tests\Unit\ERP\Items\Application\Search;

use Faker\Factory;
use Medine\ERP\Items\Application\Search\ItemSearcherRequest;

final class ItemSearcherRequestMother
{
    public static function random()
    {
        $faker = Factory::create();
        $filters = [['field' => 'companyId', 'value' => $faker->uuid]];

        return self::create($filters);
    }

    public static function create(array $filters): ItemSearcherRequest
    {
        return new ItemSearcherRequest(
            $filters,
            null, null, null, null
        );
    }
}
