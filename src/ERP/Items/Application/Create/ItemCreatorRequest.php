<?php

declare(strict_types=1);

namespace Medine\ERP\Items\Application\Create;

final class ItemCreatorRequest
{
    private $id;
    private $name;
    private $description;
    private $state;
    private $createdBy;
    private $companyId;

    public function __construct(
        string $id,
        string $name,
        ?string $description,
        string $state,
        int $createdBy,
        string $companyId
    )
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->state = $state;
        $this->createdBy = $createdBy;
        $this->companyId = $companyId;
    }

    public function id(): string
    {
        return $this->id;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function description(): ?string
    {
        return $this->description;
    }

    public function state(): string
    {
        return $this->state;
    }

    public function createdBy(): int
    {
        return $this->createdBy;
    }

    public function companyId(): string
    {
        return $this->companyId;
    }
}
