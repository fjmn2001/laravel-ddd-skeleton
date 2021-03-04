<?php

declare(strict_types=1);

namespace Medine\ERP\ItemCategories\Domain\Entity;

final class ItemCategory
{
    private $id;
    private $name;
    private $description;
    private $state;
    private $createdBy;
    private $updatedBy;
    private $companyId;
    private $createdAt;
    private $updatedAt;

    private function __construct(
        string $id,
        string $name,
        string $description,
        string $state,
        int $createdBy,
        int $updatedBy,
        string $companyId,
        \DateTimeImmutable $createdAt,
        \DateTimeImmutable $updatedAt)
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->state = $state;
        $this->createdBy = $createdBy;
        $this->updatedBy = $updatedBy;
        $this->companyId = $companyId;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
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

    public function createdBy(): int
    {
        return $this->createdBy;
    }

    public function updatedBy(): int
    {
        return $this->updatedBy;
    }

    public function companyId(): string
    {
        return $this->companyId;
    }

    public function createdAt(): \DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function updatedAt(): \DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public static function create(string $id, string $name, string $description, string $state, int $createdBy, string $companyId): self
    {
        return new self(
            $id,
            $name,
            $description,
            $state,
            $createdBy,
            $createdBy,
            $companyId,
            new \DateTimeImmutable(),
            new \DateTimeImmutable()
        );
    }
}
