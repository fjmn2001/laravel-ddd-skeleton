<?php

declare(strict_types=1);


namespace Medine\ERP\ClientCategories\Infrastructure\Persistence;

use Medine\ERP\Shared\Domain\Criteria\FilterValue;
use Medine\ERP\Shared\Infrastructure\Filters;


final class MySqlClientCategoryFilters extends Filters
{

    protected function companyId(FilterValue $value)
    {
        $value = $this->value($value->value());
        $this->builder->whereIn('client_category.company_id', $value);
    }

    protected function name(FilterValue $value)
    {
        $this->builder->where('client_category.name', 'like', "%{$value->value()}%");
    }

    protected function description(FilterValue $value)
    {
        $this->builder->where('client_category.description', 'like', "%{$value->value()}%");
    }

    protected function state(FilterValue $value)
    {
        $this->builder->where('client_category.state', 'like', "%{$value->value()}%");
    }
}
