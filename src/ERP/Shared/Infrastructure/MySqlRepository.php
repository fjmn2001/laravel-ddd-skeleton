<?php

declare(strict_types=1);

namespace Medine\ERP\Shared\Infrastructure;

use Illuminate\Database\Query\Builder;
use Illuminate\Support\Carbon;
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

    protected function formatNextCode(string $maxCode, string $year, string $prefix, $len_numero = 6, $inicia = '0'): string
    {
        $lastCode = empty($maxCode) ? 0 : (int)str_replace($prefix . $year, "", $maxCode);
        $numericPartOfCode = str_pad((string)($lastCode + 1), $len_numero, $inicia, STR_PAD_LEFT);

        return $prefix . $year . $numericPartOfCode;
    }
}
