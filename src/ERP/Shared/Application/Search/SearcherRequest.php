<?php

declare(strict_types=1);

namespace Medine\ERP\Shared\Application\Search;

abstract class SearcherRequest
{
    protected $filters;
    protected $orderBy;
    protected $order;
    protected $limit;
    protected $offset;

    public function __construct(
        array $filters,
        string $orderBy = null,
        string $order = null,
        int $limit = null,
        int $offset = null
    )
    {
        $this->filters = $filters;
        $this->orderBy = $orderBy;
        $this->order = $order;
        $this->limit = $limit;
        $this->offset = $offset;
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

    public function limit(): ?int
    {
        return $this->limit;
    }

    public function offset(): ?int
    {
        return $this->offset;
    }
}
