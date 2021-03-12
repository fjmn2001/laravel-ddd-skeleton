<?php

declare(strict_types=1);

namespace Medine\ERP\Items\Application\Find;

final class ItemFinderRequest
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
