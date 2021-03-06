<?php

declare(strict_types=1);

namespace Medine\ERP\ItemCategories\Infrastructure\Persistence;

use Medine\ERP\Shared\Domain\Criteria\FilterValue;
use Medine\ERP\Shared\Infrastructure\Filters;

final class MySqlItemCategoryFilters extends Filters
{
    protected function companyId(FilterValue $value)
    {
        $value = $this->value($value->value());
        $this->builder->whereIn('item_categories.company_id', $value);
    }

    protected function name(FilterValue $value)
    {
        $this->builder->where('item_categories.name', 'like', "%{$value->value()}%");
    }

    protected function description(FilterValue $value)
    {
        $this->builder->where('item_categories.description', 'like', "%{$value->value()}%");
    }

    protected function state(FilterValue $value)
    {
        $value = $this->value($value->value());
        $this->builder->whereIn('item_categories.state', $value);
    }
}
