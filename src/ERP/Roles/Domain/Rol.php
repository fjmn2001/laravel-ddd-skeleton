<?php

declare(strict_types=1);

namespace Medine\ERP\Roles\Domain;

final class Rol
{
    const STATUS_ACTIVE = 'active';

    private $id;
    private $name;
    private $description;
    private $superuser;
    private $status;
    private $companyId;
    private $createdAt;
    private $updatedAt;

    private function __construct(
        string $id,
        string $name,
        ?string $description,
        string $superuser,
        string $status,
        string $companyId,
        \DateTimeImmutable $createdAt,
        \DateTimeImmutable $updatedAt
    )
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->superuser = $superuser;
        $this->status = $status;
        $this->companyId = $companyId;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
    }

    public static function create(
        string $id,
        string $name,
        ?string $description,
        string $superuser,
        string $companyId
    ): self
    {
        return new self(
            $id,
            $name,
            $description,
            $superuser,
            self::STATUS_ACTIVE,
            $companyId,
            new \DateTimeImmutable(),
            new \DateTimeImmutable()
        );
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

    public function superuser(): string
    {
        return $this->superuser;
    }

    public function status(): string
    {
        return $this->status;
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
}
