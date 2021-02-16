<?php

declare(strict_types=1);

namespace Medine\ERP\Company\Infrastructure;

use Medine\ERP\Shared\Domain\Criteria\FilterValue;
use Medine\ERP\Shared\Infrastructure\Filters;

final class MySqlCompanyFilters extends Filters
{
    protected function name(FilterValue $value)
    {
        $this->builder->where('companies.name', 'like', "%{$value->value()}%");
    }
}
