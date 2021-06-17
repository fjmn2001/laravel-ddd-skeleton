<?php

declare(strict_types=1);

namespace Medine\ERP\Locations\Application\Update;

final class LocationStateUpdaterRequest
{
    private $id;
    private $state;

    public function __construct(string $id, string $state)
    {
        $this->id = $id;
        $this->state = $state;
    }

    public function id(): string
    {
        return $this->id;
    }

    public function state(): string
    {
        return $this->state;
    }
}
