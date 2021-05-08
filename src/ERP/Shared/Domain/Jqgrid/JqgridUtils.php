<?php

declare(strict_types=1);

namespace Medine\ERP\Shared\Domain\Jqgrid;

final class JqgridUtils
{
    public function pagination(int $count = 0, ?int $limit = 10, ?int $page = 1): array
    {
        $total_pages = (int)($count > 0 ? ceil($count / $limit) : 0);

        if ($page > $total_pages) {
            $page = $total_pages;
        }

        $start = $limit * $page - $limit;

        if ($start < 0) {
            $start = 0;
        }

        return [$total_pages, $page, $start];
    }
}
