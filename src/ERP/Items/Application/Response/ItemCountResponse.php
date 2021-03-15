<?php

declare(strict_types=1);

namespace Medine\ERP\Items\Application\Response;

final class ItemCountResponse
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
