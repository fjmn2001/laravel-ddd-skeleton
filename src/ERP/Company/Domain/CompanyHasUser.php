<?php

declare(strict_types=1);


namespace Medine\ERP\Company\Domain;


final class CompanyHasUser
{
    private $id;
    private $companyId;
    private $userId;
    private $rolId;
    private $status;
    private $createdAt;
    private $updatedAt;

    private function __construct(
        string $id,
        string $companyId,
        string $userId,
        string $rolId,
        string $status,
        \DateTimeImmutable $createdAt,
        \DateTimeImmutable $updatedAt
    )
    {
        $this->id = $id;
        $this->companyId = $companyId;
        $this->userId = $userId;
        $this->rolId = $rolId;
        $this->status = $status;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
    }

    public static function create(
        string $companyId,
        string $userId,
        string $rolId
    ): self
    {
        return new self(
            Uuid::random(),
            $companyId,
            $userId,
            $rolId,
            'todo: valueobje for status',
            new \DateTimeImmutable(),
            new \DateTimeImmutable()
        );
    }
    public function id(): string
    {
        return $this->id;
    }

    public function companyId(): string
    {
        return $this->companyId;
    }

    public function userId(): string
    {
        return $this->userId;
    }

    public function rolId(): string
    {
        return $this->rolId;
    }

    public function status(): string
    {
        return $this->status;
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
