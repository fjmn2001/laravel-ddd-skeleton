<?php

declare(strict_types=1);

namespace Medine\ERP\Shared\Infrastructure;

use Illuminate\Database\Query\Builder;
use Medine\ERP\Shared\Domain\Criteria;

abstract class MySqlRepository
{
    protected function completeBuilder(Criteria $criteria, Builder $query): Builder
    {
        if ($criteria->limit()) {
            $query->take($criteria->limit());
        }

        if ($criteria->offset()) {
            $query->skip($criteria->offset());
        }

        if ($criteria->order()->orderBy()->value()) {
            $query->orderBy($criteria->order()->orderBy()->value(), $criteria->order()->orderType()->value());
        }

        return $query;
    }
}
