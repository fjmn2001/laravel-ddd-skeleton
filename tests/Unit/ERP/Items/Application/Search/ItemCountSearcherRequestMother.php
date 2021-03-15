<?php

declare(strict_types=1);

namespace Tests\Unit\ERP\Items\Application\Search;

use Faker\Factory;
use Medine\ERP\Items\Application\Search\ItemCountSearcherRequest;

final class ItemCountSearcherRequestMother
{
    public static function random()
    {
        $faker = Factory::create();
        $filters = [['field' => 'companyId', 'value' => $faker->uuid]];

        return self::create($filters);
    }

    public static function create(array $filters): ItemCountSearcherRequest
    {
        return new ItemCountSearcherRequest(
            $filters,
            null, null, null, null
        );
    }
}
