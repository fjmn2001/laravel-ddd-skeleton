<?php

declare(strict_types=1);

namespace Medine\ERP\Items\Infrastructure;

use Medine\ERP\Shared\Domain\Criteria\FilterValue;
use Medine\ERP\Shared\Infrastructure\Filters;

final class MySqlItemFilters extends Filters
{
    protected function companyId(FilterValue $value)
    {
        $value = $this->value($value->value());
        $this->builder->whereIn('products.company_id', $value);
    }

    protected function code(FilterValue $value)
    {
        $value = $value->value();
        $this->builder->where('products.code', 'like', "%{$value}%");
    }

    protected function name(FilterValue $value)
    {
        $value = $value->value();
        $this->builder->where('products.name', 'like', "%{$value}%");
    }

    protected function categoryId(FilterValue $value)
    {
        $value = $this->value($value->value());
        $this->builder->whereIn('products.category_id', $value);
    }

    protected function state(FilterValue $value)
    {
        $value = $this->value($value->value());
        $this->builder->whereIn('products.state', $value);
    }
}
