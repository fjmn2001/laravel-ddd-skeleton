<?php

declare(strict_types=1);

namespace Medine\ERP\Items\Application\Update;

final class ItemStateUpdaterRequest
{
    private $id;
    private $state;
    private $updatedBy;

    public function __construct(string $id, string $state, int $updatedBy)
    {
        $this->id = $id;
        $this->state = $state;
        $this->updatedBy = $updatedBy;
    }

    public function id(): string
    {
        return $this->id;
    }

    public function state(): string
    {
        return $this->state;
    }

    public function updatedBy(): int
    {
        return $this->updatedBy;
    }
}
