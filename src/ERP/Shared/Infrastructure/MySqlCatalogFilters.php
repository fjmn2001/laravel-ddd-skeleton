<?php

declare(strict_types=1);

namespace Medine\ERP\Shared\Infrastructure;

use Medine\ERP\Shared\Domain\Criteria\FilterValue;

final class MySqlCatalogFilters extends Filters
{
    protected function module(FilterValue $value)
    {
        $this->builder->where('catalogs.module', $value->value());
    }
}
