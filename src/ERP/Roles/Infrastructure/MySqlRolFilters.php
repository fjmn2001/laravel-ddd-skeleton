<?php

declare(strict_types=1);

namespace Medine\ERP\Roles\Infrastructure;

use Medine\ERP\Shared\Domain\Criteria;
use Medine\ERP\Shared\Infrastructure\Filters;

final class MySqlRolFilters extends Filters
{
    protected function name(Criteria\FilterValue $value)
    {
        $this->builder->where('roles.name', 'like', "%{$value->value()}%");
    }
}
