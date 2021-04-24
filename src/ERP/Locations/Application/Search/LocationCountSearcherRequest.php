<?php

declare(strict_types=1);

namespace Medine\ERP\Locations\Application\Search;

final class LocationCountSearcherRequest
{
    private $filters;

    public function __construct(array $filters)
    {
        $this->filters = $filters;
    }

    public function filters(): array
    {
        return $this->filters;
    }
}
