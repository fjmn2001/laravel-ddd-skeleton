<?php

declare(strict_types=1);

namespace Medine\ERP\Locations\Application\Search;

final class LocationsSearcherResponse
{
    private $rows;
    private $page;
    private $totalPages;
    private $records;

    public function __construct(
        int $page,
        int $totalPages,
        int $records,
        array ...$rows
    )
    {

        $this->page = $page;
        $this->totalPages = $totalPages;
        $this->records = $records;
        $this->rows = $rows;
    }

    public function page(): int
    {
        return $this->page;
    }

    public function totalPages(): int
    {
        return $this->totalPages;
    }

    public function records(): int
    {
        return $this->records;
    }

    public function rows(): array
    {
        return $this->rows;
    }
}
