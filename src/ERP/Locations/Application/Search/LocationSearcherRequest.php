<?php

declare(strict_types=1);

namespace Medine\ERP\Locations\Application\Search;

final class LocationSearcherRequest
{
    private $filters;
    private $rows;
    private $page;
    private $sidx;
    private $sord;

    public function __construct(
        array $filters,
        ?int $rows,
        ?int $page,
        ?string $sidx,
        ?string $sord
    )
    {
        $this->filters = $filters;
        $this->rows = $rows;
        $this->page = $page;
        $this->sidx = $sidx;
        $this->sord = $sord;
    }

    public function filters(): array
    {
        return $this->filters;
    }

    public function rows(): ?int
    {
        return $this->rows;
    }

    public function page(): ?int
    {
        return $this->page;
    }

    public function sidx(): ?string
    {
        return $this->sidx;
    }

    public function sord(): ?string
    {
        return $this->sord;
    }
}
