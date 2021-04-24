<?php

declare(strict_types=1);

namespace Medine\ERP\Locations\Application\Search;

final class LocationCountSearcherResponse
{
    private $count;

    public function __construct(int $count)
    {
        $this->count = $count;
    }

    public function count(): int
    {
        return $this->count;
    }
}
