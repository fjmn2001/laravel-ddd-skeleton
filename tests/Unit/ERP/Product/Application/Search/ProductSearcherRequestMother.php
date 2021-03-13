<?php

declare(strict_types=1);

namespace Tests\Unit\ERP\Product\Application\Search;

use Faker\Factory;
use Medine\ERP\Product\Application\Search\ProductSearcherRequest;

final class ProductSearcherRequestMother
{
    public static function random()
    {
        $faker = Factory::create();
        $filters = [['field' => 'companyId', 'value' => $faker->uuid]];

        return self::create($filters);
    }

    public static function create(array $filters): ProductSearcherRequest
    {
        return new ProductSearcherRequest(
            $filters,
            null, null, null, null
        );
    }
}
