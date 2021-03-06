<?php

declare(strict_types=1);

namespace Medine\ERP\Product\Application\Find;

final class FindProductRequest
{
    private $id;

    public function __construct(string $id)
    {
        $this->id = $id;
    }

    public function id(): string
    {
        return $this->id;
    }

}
