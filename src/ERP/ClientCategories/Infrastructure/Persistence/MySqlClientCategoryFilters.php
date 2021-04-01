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
}
