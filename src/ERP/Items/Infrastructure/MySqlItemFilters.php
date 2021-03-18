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
}
