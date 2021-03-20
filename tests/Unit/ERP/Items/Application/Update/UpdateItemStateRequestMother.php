<?php

declare(strict_types=1);

namespace Tests\Unit\ERP\Items\Application\Update;

use Faker\Factory;
use Medine\ERP\Items\Application\Update\ItemStateUpdaterRequest;

final class UpdateItemStateRequestMother
{
    public static function create(
        string $id,
        string $state,
        int $updatedBy
    ): ItemStateUpdaterRequest
    {
        return new ItemStateUpdaterRequest(
            $id,
            $state,
            $updatedBy
        );
    }

    public static function withId(string $itemId): ItemStateUpdaterRequest
    {
        $faker = Factory::create();

        return self::create(
            $itemId,
            $faker->randomElement(['active', 'inactive']),
            $faker->numberBetween(1)
        );
    }
}
