<?php

declare(strict_types=1);

namespace Medine\ERP\Items\Application\Search;

final class ItemCountSearcherRequest
{
    private $filters;
    private $order_by;
    private $order;
    private $limit;
    private $offset;

    public function __construct(
        array $filters,
        ?string $order_by,
        ?string $order,
        ?int $limit,
        ?int $offset
    )
    {
        $this->filters = $filters;
        $this->order_by = $order_by;
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
        return $this->order_by;
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
