<?php

declare(strict_types=1);

namespace Medine\ERP\Product\Application\Response;

final class ProductCountResponse
{
    private $count;

    public function __construct(int $count)
    {
        $this->count = $count;
    }

    public function count(): int
    {
        return $this->count;
    }
}
