<?php

declare(strict_types=1);

namespace Medine\ERP\Locations\Application\Find;

final class LocationFinderRequest
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
