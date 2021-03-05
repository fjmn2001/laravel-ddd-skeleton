<?php

declare(strict_types=1);

namespace Medine\ERP\ItemCategories\Infrastructure\Persistence;

use Medine\ERP\Shared\Domain\Criteria\FilterValue;
use Medine\ERP\Shared\Infrastructure\Filters;

final class MySqlItemCategoryFilters extends Filters
{
    protected function companyId(FilterValue $value)
    {
        $this->builder->where('item_categories.company_id', $value->value());
    }
}
