<?php

declare(strict_types=1);

namespace Medine\ERP\Items\Infrastructure\Persistence;

use Medine\ERP\Shared\Domain\Criteria\FilterValue;
use Medine\ERP\Shared\Infrastructure\Filters;

final class MySqlItemFilters extends Filters
{
    protected function companyId(FilterValue $value)
    {
        $value = $this->value($value->value());
        $this->builder->whereIn('items.company_id', $value);
    }

    protected function name(FilterValue $value)
    {
        $this->builder->where('items.name', 'like', "%{$value->value()}%");
    }

    protected function description(FilterValue $value)
    {
        $this->builder->where('items.description', 'like', "%{$value->value()}%");
    }

    protected function state(FilterValue $value)
    {
        $value = $this->value($value->value());
        $this->builder->whereIn('items.state', $value);
    }
}
