<?php

declare(strict_types=1);

namespace Medine\ERP\Users\Infrastructure;

use Medine\ERP\Shared\Domain\Criteria\FilterValue;
use Medine\ERP\Shared\Infrastructure\Filters;

final class MySqlPasswordResetFilters extends Filters
{
    protected function email(FilterValue $value)
    {
        $this->builder->where('password_resets.email', $value->value());
    }

    protected function token(FilterValue $value)
    {
        $this->builder->where('password_resets.token', $value->value());
    }
}
