<?php

declare(strict_types=1);

namespace Medine\ERP\ItemCategories\Application\Update;

final class ItemCategoryUpdaterRequest
{
    private $id;
    private $name;
    private $description;
    private $state;
    private $updatedBy;

    public function __construct(
        string $id,
        string $name,
        string $description,
        string $state,
        int $updatedBy
    )
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->state = $state;
        $this->updatedBy = $updatedBy;
    }

    public function id(): string
    {
        return $this->id;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function description(): string
    {
        return $this->description;
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
