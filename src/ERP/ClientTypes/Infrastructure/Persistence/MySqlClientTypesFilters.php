<?php

declare(strict_types=1);

namespace Medine\ERP\ClientTypes\Infrastructure\Persistence;

use Medine\ERP\Shared\Domain\Criteria\FilterValue;
use Medine\ERP\Shared\Infrastructure\Filters;

final class MySqlClientTypesFilters extends Filters
{

    protected function companyId(FilterValue $value)
    {
        $value = $this->value($value->value());
        $this->builder->whereIn('client_type.company_id', $value);
    }

    protected function name(FilterValue $value)
    {
        $this->builder->where('client_type.name', 'like',  "%{$value->value()}%");
    }

    protected function description(FilterValue $value)
    {
        $this->builder->where('client_type.description', 'like',  "%{$value->value()}%");
    }

    protected function state(FilterValue $value)
    {
        $this->builder->where('client_type.state', 'like',  "%{$value->value()}%");
    }
}
