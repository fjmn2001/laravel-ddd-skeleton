<?php

declare(strict_types=1);

namespace Medine\ERP\Locations\Application\Search;

final class LocationSearcherRequest
{
    private $filters;
    private $orderBy;
    private $order;
    private $offset;
    private $limit;

    public function __construct(
        array $filters,
        ?string $orderBy,
        ?string $order,
        ?int $offset,
        ?int $limit
    )
    {
        $this->filters = $filters;
        $this->orderBy = $orderBy;
        $this->order = $order;
        $this->offset = $offset;
        $this->limit = $limit;
    }

    public function filters(): array
    {
        return $this->filters;
    }

    public function orderBy(): ?string
    {
        return $this->orderBy;
    }

    public function order(): ?string
    {
        return $this->order;
    }

    public function offset(): ?int
    {
        return $this->offset;
    }

    public function limit(): ?int
    {
        return $this->limit;
    }
}
