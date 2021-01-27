<?php

declare(strict_types=1);

namespace Medine\ERP\Roles\Application\Find;

final class RolFinderRequest
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
