<?php

declare(strict_types=1);

namespace Medine\ERP\Company\Infrastructure;

use Illuminate\Database\Query\JoinClause;
use Medine\ERP\Shared\Domain\Criteria\FilterValue;
use Medine\ERP\Shared\Infrastructure\Filters;

final class MySqlCompanyFilters extends Filters
{
    protected function name(FilterValue $value)
    {
        $this->builder->where('companies.name', 'like', "%{$value->value()}%");
    }

    protected function state(FilterValue $value)
    {
        $this->builder->whereIn('companies.state', $value->value());
    }

    protected function user(FilterValue $value)
    {
        $this->builder->join('company_has_user', function (JoinClause $join) use ($value) {
            $join->on('company_has_user.company_id', '=', 'companies.id');
            $join->whereIn('company_has_user.user_id', $value->value());
        });
    }
}
