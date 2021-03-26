<?php

declare(strict_types=1);

namespace Medine\ERP\Clients\Infrastructure\Repository;

use Medine\ERP\Shared\Domain\Criteria\FilterValue;
use Medine\ERP\Shared\Infrastructure\Filters;

final class MySqlClientsFilters extends Filters
{
    protected function companyId(FilterValue $value)
    {
        $value = $this->value($value->value());
        $this->builder->whereIn('clients.company_id', $value);
    }

    protected function name(FilterValue $value)
    {
        $this->builder->where('clients.name', 'like', "%{$value->value()}%");
    }

}
